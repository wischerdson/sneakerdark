<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;
use App;

use XmlParser;

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

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */

	private function insertData($model, $data, $forceInsert = false) {
		if (count($data) < 200 and !$forceInsert)
			return false;

		$model::insert($data);
		return true;
	}

	public function handle()
	{
		//downloadFile(config('app.import_link'), storage_path('app/sneakerdark/').'import_1.xml');
		//downloadFile('https://sportomax.com/wa-data/public/shop/plugins/ymlexport/document.xml', storage_path('app/sneakerdark/').'import_1.xml');

		$xml = XmlParser::load(storage_path('app/sneakerdark/').'import.xml');

		$collection = [];
		$collectionDescription = [];

		$xml->parseCategory([
			'id' => 'category:id',
			'parent_id' => ':parentId',
			'name' => 'category',
			'a' => [
				'hehe' => ':id'
			]
		], function ($data) {
			dump($data);
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
