<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Storage;
use App;

use XmlParser;

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

	public function handle()
	{

		/*$xml = XmlParser::download(
			config('app.import_link'),
			storage_path('app/sneakerdark/').'vk.txt'
		);*/

		$xml = XmlParser::load(storage_path('app/sneakerdark/').'import.xml');
		$xml->parse([
			[
				'trigger' => 'category',
				'pattern' => [
					'id' => ':id',
					'parentId' => ':parentId',
					'title' => 'category',
				],
				'callback' => function ($data) {

				}
			],
			[
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
			]
		]);

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
