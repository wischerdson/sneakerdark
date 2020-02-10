<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;
use App;

use Sneakerdark\XmlParser\Document as XmlParser;
use Cviebrock\EloquentSluggable\Services\SlugService;

use App\Attribute;
use App\AttributeDescription;
use App\Collection;
use App\CollectionDescription;
use App\Product;
use App\ProductDescription;
use App\ProductImage;
use App\ProductAttribute;
use App\ProductOption;
use App\ProductOptionValue;

class Catalog_Update extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'catalog:update {--force}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update product catalog';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	private function importCollections($xml)
	{
		$collectionsIds = Collection::select('supplier_id')->pluck('supplier_id')->toArray();

		$xml->parseCategory([
			'supplier_id' => 'category:id',
			'parent_id' => 'category:parentId',
			'name' => 'category'
		], function ($data) use ($collectionsIds) {
			if (!in_array($data['supplier_id'], $collectionsIds)) {
				$collection = new Collection;
				$collection->supplier_id = $data['supplier_id'];
				$collection->parent_id = $data['parent_id'];
				$collection->alias = SlugService::createSlug(Collection::class, 'alias', $data['name']);
				$collection->save();
				
				$collectionDescription = new CollectionDescription;
				$collectionDescription->collection_id = $collection->id;
				$collectionDescription->name = $data['name'];
				$collectionDescription->meta_title = $data['name'];
				$collectionDescription->save();
			}
		});
	}

	private function importAttributes($xml)
	{
		$attributes = AttributeDescription::select('name')->distinct()->pluck('name')->toArray();

		$xml->parseOffer([
			'name' => 'offer.param:name'
		], function ($data) use (&$attributes) {
			foreach ((array) $data['name'] as $key => $value) {
				if (preg_match('/(р|Р)азмер/i', $value))
					continue;

				if (!in_array($value, $attributes)) {
					$attribute = new Attribute;
					$attribute->save();

					$attributeDescription = new AttributeDescription;
					$attributeDescription->attribute_id = $attribute->id;
					$attributeDescription->name = $value;
					$attributeDescription->save();

					$attributes[] = $value;
				}
			}
		});
	}

	private function importProducts($xml)
	{
		$collections = (array) Collection::select(['id', 'supplier_id'])->pluck('id', 'supplier_id')->toArray();
		$attributes = AttributeDescription::select('name', 'attribute_id')->distinct()->pluck('attribute_id', 'name')->toArray();
		$oldProducts = Product::withoutGlobalScope('instock')->select('sku')->pluck('sku')->toArray();
		$newlyAddedProducts = [];

		$xml->parseOffer([
			'sku' => 'offer:group_id',
			'sku2' => 'offer:id',
			'base_price' => 'offer.price',
			'collection_id' => 'offer.categoryId',
			'supplier_url' => 'offer.url',
			'shipping' => 'offer.delivery',
			'instock' => 'offer.outlets.outlet:instock',
			'attribute_name' => 'offer.param:name',
			'attribute_value' => 'offer.param',
			'name' => 'offer.name',
			'vendor' => 'offer.vendor',
			'model' => 'offer.model',
			'description' => 'offer.description',
			'images' => 'offer.picture'
		], function ($data) use ($collections, &$newlyAddedProducts, $oldProducts, $attributes) {
			$data['sku'] = $data['sku'] ?? $data['sku2'];

			$productCurrentID = null;

			if (in_array($data['sku'], $newlyAddedProducts))
				return;

			if (in_array($data['sku'], $oldProducts)) {
				$product = Product::withoutGlobalScope('instock')->where('sku', $data['sku'])->first();
				$product->deletion_candidate = false;
				$product->base_price = $data['base_price'];
				$product->save();

				$newlyAddedProducts[] = $data['sku'];
			} else {
				$product = new Product;
				$product->sku = $data['sku'];
				$product->base_price = $data['base_price'];
				$product->price = $data['base_price'];
				$product->collection_id = $collections[$data['collection_id']];
				$product->supplier_url = $data['supplier_url'];
				$product->shipping = $data['shipping'] == 'true' ? 1 : 0;
				$slug = preg_replace('/\d/', '', $data['name']);
				$product->alias = SlugService::createSlug(Product::class, 'alias', $data['name'].' '.$data['sku']);
				$product->save();
				$productCurrentID = $product->id;
				unset($product);

				$productImages = [];
				foreach ((array) $data['images'] as $image) {
					$productImage = [];
					$productImage['supplier_src'] = $image;
					$productImage['product_id'] = $productCurrentID;
					$productImage['created_at'] = time();
					$productImage['updated_at'] = time();

					$productImages[] = $productImage;
				}
				ProductImage::insert($productImages);
				
				$data['meta_title'] = $data['name'].' купить по цене {{ $price }} в интернет-магазине sneakerdark.ru с доставкой';
				
				$data['meta_description'] = $data['name'].' купить в интернет-магазине sneakerdark.ru по выгодной цене {{ $price }}. Большой выбор товаров по низким ценам! Акции и скидки на сайте. Есть доставка. Звоните 8-800-505-42-51.';

				$data['description'] = preg_replace('/&lt;/', '<', $data['description']);
				$data['description'] = preg_replace('/&gt;/', '>', $data['description']);
				$data['description'] = preg_replace('/&amp;/', '&', $data['description']);
				$data['description'] = preg_replace('/ style=".*?"/', '', $data['description']);

				$productDescription = new ProductDescription;
				$productDescription->product_id = $productCurrentID;
				$productDescription->name = $data['name'];
				$productDescription->description = $data['description'];
				$productDescription->model = $data['model'];
				$productDescription->vendor = $data['vendor'];
				$productDescription->meta_title = $data['meta_title'];
				$productDescription->meta_description = $data['meta_description'];
				$productDescription->save();
				unset($productDescription);

				$productAttributes = [];
				foreach ((array) $data['attribute_name'] as $key => $value) {
					if (preg_match('/(р|Р)азмер/i', $value)) {
						$productOption = new ProductOption;
						$productOption->product_id = $productCurrentID;
						$productOption->name = $value;
						$productOption->save();
						unset($productOption);
					} else {
						$productAttribute = [];
						$productAttribute['product_id'] = $productCurrentID;
						$productAttribute['attribute_id'] = $attributes[$value];
						$productAttribute['text'] = ((array) $data['attribute_value'])[$key];
						
						$productAttributes[] = $productAttribute;
					}
				}
				ProductAttribute::insert($productAttributes);

				$newlyAddedProducts[] = $data['sku'];
			}
		});
	}

	private function import_productOptionValue($xml)
	{
		$sku_productId = Product::withoutGlobalScope('instock')->select('id', 'sku')->pluck('sku', 'id')->toArray();
		$productsOptionsIds = ProductOption::select('id', 'product_id')->pluck('id', 'product_id')->toArray();
		$sku_optionId = [];
		$been = [];

		foreach ($productsOptionsIds as $productId => $optionId) {
			$sku = $sku_productId[$productId];
			$sku_optionId[$sku] = $optionId;
		}

		unset($productsOptionsIds);

		Product::withoutGlobalScope('instock')->where('deletion_candidate', true)->update(['deleted_at' => time()]);
		\DB::table('product')->update(['deletion_candidate' => false]);

		$xml->parseOffer([
			'sku' => 'offer:group_id',
			'sku2' => 'offer:id',
			'attribute_name' => 'offer.param:name',
			'attribute_value' => 'offer.param',
			'instock' => 'offer.outlets.outlet:instock'
		], function ($data) use ($sku_optionId, &$been) {
			$data['sku'] = $data['sku'] ?? $data['sku2'];

			foreach ((array) $data['attribute_name'] as $key => $value) {
				if (preg_match('/(р|Р)азмер/i', $value)) {
					$productOptionValue = ProductOptionValue::
						where('product_option_id', $sku_optionId[$data['sku']])->
						where('value', $data['attribute_value'][$key])->
						first();

					if (!$productOptionValue) {
						$productOptionValue = new ProductOptionValue;
						$productOptionValue->product_option_id = $sku_optionId[$data['sku']];
						$productOptionValue->instock = $data['instock'];
						$productOptionValue->value = $data['attribute_value'][$key];
						$productOptionValue->save();
					} else {
						$productOptionValue->instock = $data['instock'];
						$productOptionValue->save();
					}
				}
			}

			if (!in_array($data['sku'], $been)) {
				$product = Product::withoutGlobalScope('instock')->where('sku', $data['sku'])->first();
				$product->instock = $data['instock'];
				$product->save();
				$been[] = $data['sku'];
			} else {
				Product::withoutGlobalScope('instock')->where('sku', $data['sku'])->first()->increment('instock', $data['instock']);
			}
		});
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
/*		$startExecutionTime = time();
		$stopwatch = time();

*/
		$file = storage_path('app/sneakerdark/').'import_1.xml';
		

		downloadFile(config('app.import_link'), $file);
		$hashFileExists = Storage::disk('sneakerdark')->exists('last_hash.txt');

		if (!$hashFileExists)
			Storage::disk('sneakerdark')->put('last_hash.txt', '');

		$hashFileContent = Storage::disk('sneakerdark')->get('last_hash.txt');
		$hash = hash_file('md5', $file);

		if ($hashFileContent === $hash && !$this->options()['force']) {
			$this->comment('No updates is required.');
			return;
		}
		Storage::disk('sneakerdark')->put('last_hash.txt', $hash);

		new \Sneakerdark\Import\Main($file, $this);
		\Artisan::call('catalog:images');

		
		return;


		\DB::table('product')->update(['deletion_candidate' => true]);

		//downloadFile('https://sportomax.com/wa-data/public/shop/plugins/ymlexport/document.xml', storage_path('app/sneakerdark/').'import_1.xml');

		$xml = new \Sneakerdark\XmlParser\Document($file);
		$this->importCollections($xml);
		$this->importAttributes($xml);
		$this->info('Collection, CollectionDescription, Attribute, AttributeDescription');
		$stopwatch = time();
		$xml->start();
		$this->line('Execution time: '.(time() - $stopwatch).'s');

		unset($xml);

		$xml = new XmlParser($file);
		$this->importProducts($xml);
		$this->info('Product, ProductDescription, ProductAttribute, ProductOption, ProductImage');
		$stopwatch = time();
		$xml->start();
		$this->line('Execution time: '.(time() - $stopwatch).'s');

		unset($xml);

		$xml = new XmlParser($file);
		$this->import_productOptionValue($xml);
		$this->info('ProductOptionValue');
		$stopwatch = time();
		$xml->start();
		$this->line('Execution time: '.(time() - $stopwatch).'s');
		$this->line('Total execution time: '.(time() - $startExecutionTime).'s');

		\Artisan::call('catalog:images');

		return;


		/*$this->comment('Yml downloading...');
		$sneakerdarkImport = App::make(App\Helpers\SneakerdarkImport::class);

		$hashFileExists = Storage::disk('sneakerdark')->exists('last_hash.txt');

		if (!$hashFileExists)
			Storage::disk('sneakerdark')->put('last_hash.txt', '');

		$hashFileContent = Storage::disk('sneakerdark')->get('last_hash.txt');
		$hash = $sneakerdarkImport->hash;

		if ($hashFileContent === $hash) {
			$this->comment('No updates is required.');
			return;
		}
		Storage::disk('sneakerdark')->put('last_hash.txt', $hash);

		$tables = explode(',', $this->argument('tables'));
		$a = [
			'category' => array_intersect(['collections'], $tables),
			'offer' => array_intersect(['products','parameters','pictures','sizes'], $tables)
		];

		$this->comment('Importing...');
		$sneakerdarkImport->start($a);*/
	}
}
