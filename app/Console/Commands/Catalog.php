<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App;

//use App\Repository\Bizoutmax;

use App\Helpers\Contracts\Bizoutmax;

use App\Category;
use App\Product;
use App\Parameter;
use App\Picture;
use App\Size;

class Catalog extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'catalog:update {table=all}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Updating product catalog from bizoutmax shop';

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
		$tables = $this->argument('table');
		if ($tables == 'all')
			$tables = 'categories,products,parameters,pictures,sizes';
		$tables = explode(',', $tables);


		$a = [
			'category' => ['categories'],
			'offer' => ['products','parameters','pictures','sizes']
		];

		$result1 = array_intersect($a['category'], $tables);
		$result2 = array_intersect($a['offer'], $tables);

		$a = [
			'category' => $result1,
			'offer' => $result2
		];

		$this->comment('Yml downloading...');
		$bizoutmax = App::make(App\Helpers\Bizoutmax::class);
		$this->comment('Importing...');
		$bizoutmax->import($a);
	}
}
