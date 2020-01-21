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
		$id = Collection::max('id');

		$xml->parseCategory([
			'supplier_id' => 'category:id',
			'parent_id' => 'category:parentId',
			'name' => 'category'
		], function ($data) use ($collectionsIds, &$id, &$bar) {
			if (!in_array($data['supplier_id'], $collectionsIds)) {
				$id++;

				$collection = new Collection;
				$collection->id = $id;
				$collection->supplier_id = $data['supplier_id'];
				$collection->parent_id = $data['parent_id'];
				$collection->save();
				
				$collectionDescription = new CollectionDescription;
				$collectionDescription->collection_id = $id;
				$collectionDescription->name = $data['name'];
				$collectionDescription->meta_title = $data['name'];
				$collectionDescription->save();
			}
		});
	}

	private function importAttributes($xml)
	{
		$attributes = AttributeDescription::select('name')->distinct()->pluck('name')->toArray();
		$id = Attribute::max('id') ?? 1;

		$xml->parseOffer([
			'name' => 'offer.param:name'
		], function ($data) use (&$id, &$attributes) {
			foreach ((array) $data['name'] as $key => $value) {
				if (!in_array($value, $attributes)) {
					$attribute = new Attribute;
					$attribute->id = $id;
					$attribute->sort_order = $id;
					dump($attribute->save()->id);

					$attributeDescription = new AttributeDescription;
					$attributeDescription->attribute_id = $id;
					$attributeDescription->name = $value;
					$attributeDescription->save();

					$attributes[] = $value;

					$id++;
				}
			}
		});
	}

	private function importProducts($xml)
	{
		
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

		$xml = new XmlParser(storage_path('app/sneakerdark/').'import.xml');

		$this->importCollections($xml);
		$this->importAttributes($xml);
		$this->importProducts($xml);
		//$this->importProductsImages($xml);

		$xml->start();

		return;

		

		
		$xml->parseCategory([
			'123_id' => 'category:id',
			'123_parent_id' => 'category:parentId',
			'123_name' => 'category'
		], function ($data) {
			dump($data);
		});

		$xml->parseOffer([
			'sku' => 'offer:group_id',
			'supplier_url' => 'offer.url',
			'price' => 'offer.price',
			'collection_id' => 'offer.categoryId',
			'images' => 'offer.picture'
		], function ($data) {
			//dump($data);
		});

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

		$xml->start();

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
