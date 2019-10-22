<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Repository\Bizoutmax;

use App\Category;
use App\Product;
use App\Parameter;
use App\Picture;
use App\Size;

class CatalogUpdate extends Command
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

	private $bizoutmax;
	private $j = 1;
	private $bar;
	private $ex = [];

	public function handle()
	{
		$this->bizoutmax = new Bizoutmax( config('app.import_link') );
		\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		$this->{ $this->argument('table') }();
		\DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
	private function all() {
		$this->categories();
		$this->products();
		$this->parameters();
		$this->pictures();
		$this->sizes();
	}

	private function sizes() {
		$this->comment('Sizes importing');

		$old_count = Picture::count();
		$new_count = $this->get_sizes_count();

		$this->bar = $this->output->createProgressBar($new_count);
		$this->bar->start();

		$this->j = 0;

		$this->iterate_products(null, function ($i, $product) {
			foreach ($product->param as $key => $value) {
				if (preg_match('/Размер/', $value['name'])) {
					$this->j++;
					Size::updateOrCreate(['id' => $this->j], [
						'product_id' => $product->vendorCode,
						'size' => (string) $value,
						'instock' => $product->outlets->outlet[0]['instock'] < 0 ? 0 : $product->outlets->outlet[0]['instock'],
						'available' => $product['available'] ? 1 : 0,
						'bizoutmax_id' => $product['id'],
						'delivery' => $product->delivery ? 1 : 0
					]);
					$this->bar->advance();
				}
			}
		});

		if ($new_count < $old_count)
			Size::where('id', '>', $new_count)->delete();

		$this->bar->finish();
		$this->line('');
	}

	private function pictures() {
		$this->comment('Pictures importing');

		$old_count = Picture::count();
		$new_count = $this->get_pictures_count();

		$this->bar = $this->output->createProgressBar($new_count);
		$this->bar->start();

		$this->j = 0;

		$this->iterate_products(function ($i, $product) {
			foreach ($product->picture as $key => $picture) {
				$this->j++;
				Picture::updateOrCreate(['id' => $this->j], [
					'product_id' => $i,
					'src' => (string) $picture,
						// 'width' => getimagesize((string) $picture)[0],
						// 'height' => getimagesize((string) $picture)[1],
				]);
				$this->bar->advance();
			}
		});

		if ($new_count < $old_count)
			Picture::where('id', '>', $new_count)->delete();
		
		$this->bar->finish();
		$this->line('');
	}
	private function categories() {
		$this->comment('Categories importing');
		$i = 0;
		$old_categories_count = Category::count();

		foreach ($this->bizoutmax->get_categories() as $category) {
			$i++;
			Category::updateOrCreate(
				['id' => $i],
				[
					'bizoutmax_id' => $category['id'],
					'value' => $category
				]
			);
		}

		if ($i < $old_categories_count)
			Category::where('id', '>', $i)->delete();

		$this->info('Categories has been imported');
	}
	private function parameters() {
		$this->comment('Parameters importing');

		$old_count = Parameter::count();
		$new_count = $this->get_parameters_count();

		$this->bar = $this->output->createProgressBar($new_count);
		$this->bar->start();

		$this->j = 0;
		$this->ex = [];

		$this->iterate_products(function () {
			$this->ex = [];
		}, function ($i, $product) {
			foreach ($product->param as $key => $value) {
				if (!in_array([(string) $value['name'] => (string) $value[0]], $this->ex)) {
					if (preg_match('/Размер/', $value['name'], $matches)) continue;
					$this->j++;

					Parameter::updateOrCreate(['id' => $this->j], [
						'product_id' => $i,
						'key' => $value['name'],
						//'key' => preg_match('/Размер/', $value['name'], $matches) ? 'Размер' : $value['name'],
						'value' => $value[0]
					]);
					$this->bar->advance();
					
					array_push($this->ex, [(string) $value['name'] => (string) $value[0]]);
				}
			}
		});

		if ($new_count < $old_count)
			Parameter::where('id', '>', $new_count)->delete();
		
		$this->bar->finish();
		$this->line('');
	}
	private function products() {
		$this->comment('Products importing');

		$this->truncate_table(Product::class);
		$new_count = $this->get_products_count();

		$this->bar = $this->output->createProgressBar($new_count);
		$this->bar->start();

		$this->iterate_products(function ($i, $product) {
			Product::updateOrCreate(
				['id' => $i],
				[
					'title' => $product->name,
					'price' => $product->price,
					'article' => $product->vendorCode,
					'bizoutmax_url' => $product->url,
					'category_id' => $product->categoryId,
					'model' => $product->model,
					'description' => $product->description,
					'vendor' => $product->vendor
				]
			);
			$this->bar->advance();
		});

		$this->bar->finish();
		$this->line('');
	}

	

	private function get_products_count() {
		return $this->iterate_products();
	}
	private function get_parameters_count() {
		$this->j = 0;
		$this->ex = [];

		$this->iterate_products(function () {
			$this->ex = [];
		}, function ($i, $product) {
			foreach ($product->param as $key => $value) {
				if (!in_array([(string) $value['name'] => (string) $value[0]], $this->ex)) {
					if (preg_match('/Размер/', $value['name'], $matches)) continue;
					$this->j++;
					array_push($this->ex, [(string) $value['name'] => (string) $value[0]]);
				}
			}
		});
		return $this->j;
	}
	private function get_pictures_count() {
		$this->j = 0;

		$this->iterate_products(function ($i, $product) {
			foreach ($product->picture as $key => $picture) {
				$this->j++;
			}
		});
		return $this->j;
	}
	private function get_sizes_count() {
		$this->j = 0;

		$this->iterate_products(null, function ($i, $product) {
			foreach ($product->param as $key => $value) {
				if (preg_match('/Размер/', $value['name']))
					$this->j++;
			}
		});

		return $this->j;
	}




	private function iterate_products($user_function_1 = null, $user_function_2 = null) {
		$ex_ids = [];
		$current_product_id = 0;

		foreach ($this->bizoutmax->get_products() as $product) {
			$article = ((array) $product->vendorCode)[0];
			if (!in_array($article, $ex_ids)) {
				array_push($ex_ids, $article);
				$current_product_id++;
				$user_function_1 ? $user_function_1($current_product_id, $product) : '';
			}
			$user_function_2 ? $user_function_2($current_product_id, $product) : '';
		}

		return $current_product_id;
	}

	private function truncate_table($model) {
		\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		$model::truncate();
		\DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}
