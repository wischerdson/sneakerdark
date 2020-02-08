<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Product;
use App\ProductImage;

class DownloadImages extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'catalog:images';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description';

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
		$bar = $this->output->createProgressBar(ProductImage::where('src', null)->count());
		$bar->start();

		foreach (ProductImage::where('src', null)->cursor() as $image) {
			preg_match('/https?:\/\/.*\.(\w+)$/i', $image->supplier_src, $matches);
			$file = 'image/products/'.$image->product_id.'-'.$image->id.'.'.$matches[1];
			//downloadFile($image->supplier_src, public_path().'/'.$file);
			$image->src = $file;
			$image->save();
			$bar->advance();
		}

		$bar->finish();

		foreach (Product::withoutGlobalScope('instock')->where('image', null)->with('images')->cursor() as $product) {
			$product->image = $product->images[0]->src;
			$product->save();
		}
	}
}
