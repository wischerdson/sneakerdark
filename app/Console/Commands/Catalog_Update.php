<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App;

use App\Helpers\Contracts\Bizoutmax;

class Catalog_Update extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'catalog:update {tables=categories,products,parameters,pictures,sizes}';

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
		$this->comment('Yml downloading...');
		$bizoutmax = App::make(App\Helpers\Bizoutmax::class);

		$oldHashFile = storage_path('app/bizoutmax/').'last_hash.txt';

		$oldHash = file_get_contents($oldHashFile);
		$hash = $bizoutmax->hash;

		if ($oldHash === $hash) {
			$this->comment('No updates is required.');
			return;
		}
		file_put_contents($oldHashFile, $hash);

		$tables = explode(',', $this->argument('tables'));
		$a = [
			'category' => array_intersect(['categories'], $tables),
			'offer' => array_intersect(['products','parameters','pictures','sizes'], $tables)
		];


		$this->comment('Importing...');
		$bizoutmax->import($a);
	}
}
