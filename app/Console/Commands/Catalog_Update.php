<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;
use App;

use Wsn\XmlParser\Document as XmlParser;

use App\Attribute;
use App\AttributeDescription;
use App\Collection;
use App\CollectionDescription;
use App\Product;
use App\ProductDescription;
use App\ProductAttribute;

class Catalog_Update extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'catalog:update {tables=collections,products,parameters,pictures,sizes}';

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
		$oldProducts = Product::select('sku')->pluck('sku')->toArray();
		$newlyAddedProducts = [];

		$xml->parseOffer([
			'sku' => 'offer:group_id',
			'sku2' => 'offer:id',
			'base_price' => 'offer.price',
			'collection_id' => 'offer.categoryId',
			'supplier_url' => 'offer.url',
			'shipping' => 'offer.delivery',
			'instock' => 'offer.outlets.outlet:instock',
			'attribute_name' => 'offer.param.name',
			'attribute_value' => 'offer.param',
			'name' => 'offer.name',
			'vendor' => 'offer.vendor',
			'model' => 'offer.model',
			'description' => 'offer.description'
		], function ($data) use ($collections, &$newlyAddedProducts, $oldProducts, $attributes) {
			$data['sku'] = $data['sku'] ?? $data['sku2'];

			if (in_array($data['sku'], $newlyAddedProducts))
				return;

			if (in_array($data['sku'], $oldProducts)) {
				$product = Product::where('sku', $data['sku'])->first();
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
				$product->save();


				$data['meta_title'] = $data['name'].' купить по цене {{ $price }} в интернет-магазине sneakerdark.ru с доставкой';
				
				$data['meta_description'] = $data['name'].' купить в интернет-магазине sneakerdark.ru по выгодной цене {{ $price }}. Большой выбор товаров по низким ценам! Акции и скидки на сайте. Есть доставка. Звоните 8-800-505-42-51.';

				$data['description'] = preg_replace('/&lt;/', '<', $data['description']);
				$data['description'] = preg_replace('/&gt;/', '>', $data['description']);
				$data['description'] = preg_replace('/&amp;/', '&', $data['description']);
				$data['description'] = preg_replace('/ style=".*?"/', '', $data['description']);

				$productDescription = new ProductDescription;
				$productDescription->product_id = $product->id;
				$productDescription->name = $data['name'];
				$productDescription->description = $data['description'];
				$productDescription->model = $data['model'];
				$productDescription->vendor = $data['vendor'];
				$productDescription->meta_title = $data['meta_title'];
				$productDescription->meta_description = $data['meta_description'];
				$productDescription->save();

				foreach ((array) $data['attribute_name'] as $key => $value) {
					if (preg_match('/(р|Р)азмер/i', $value))
						continue;

					$productAttribute = new ProductAttribute();
					$productAttribute->product_id = $product->id;
					$productAttribute->attribute_id = $attributes[$value];
					$productAttribute->text = ((array) $data['attribute_value'])[$key];
					$productAttribute->save();
				}

				$newlyAddedProducts[] = $data['sku'];
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
		//downloadFile(config('app.import_link'), storage_path('app/sneakerdark/').'import_1.xml');
		//downloadFile('https://sportomax.com/wa-data/public/shop/plugins/ymlexport/document.xml', storage_path('app/sneakerdark/').'import_1.xml');

		$xml1 = new XmlParser(storage_path('app/sneakerdark/').'import_1.xml');

		$this->importCollections($xml1);
		$this->importAttributes($xml1);


		$xml1->start();

		$xml2 = new XmlParser(storage_path('app/sneakerdark/').'import_1.xml');
		$this->importProducts($xml2);

		$xml2->start();

		return;

		/*$xml->parseCategory(function ($data) use (&$collection, &$collectionDescription) {
			dump((int) $data['id']);
			$collection[] = [
				'id' => (int) $data['id'],
				'parent_id' => (int) $data['parentId'],
				'created_at' => time(),
				'updated_at' => time()
			];
			$collectionDescription[] = [
				'collection_id' => (int) $data['id'],
				'name' => (string) $data[0],
				'meta_title' => (string) $data[0]
			];

			if ($this->insertData(Collection::class, $collection))
				$collection = [];
			if ($this->insertData(CollectionDescription::class, $collectionDescription))
				$collectionDescription = [];
		});

		$xml->parseOffer(function ($data) {
			
		});
		$xml->parseOffer(function ($data) {
			
		});*/

		/*$xml->parseCategory([
			'id' => ':id',
			'parentId' => ':parentId',
			'title' => ':id'
		], function ($data) {
			dump($data);
		});*/

		//$xml->start();


		/*

		$xml->parseCategory([
			'alternative_id' => ':id',
			'alternative_parentId' => ':parentId',
			'alternative_title' => 'category'
		], function ($data) {
			dump($data);
		});*/
		
/*			[
				'trigger' => 'offer',
				'pattern' => [
					'article' => 'vendorcode',
					'price' => 'price',
					'categoryId' => 'categoryid',
					'pictures' => 'picture',
					'title' => 'name',
					'vendor' => 'vendor',
					'model' => 'model',
					'description' => 'description',
					'instock' => 'outlets.outlet:instock',
					'attributes' => [
						[
							'name' => 'param:name',
							'unit' => 'param:unit',
							'value' => 'param'
						]
					]
				],
				'callback' => function ($data) {

				}
			],
			[
				'trigger' => 'offer',
				'pattern' => [
					'attributes' => [
						[
							'name' => 'param:name',
							'unit' => 'param:unit',
							'value' => 'param'
						]
					]
				],
				'callback' => function ($data) {

				}
			]*/
		//]);

		//dd($xml);


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
