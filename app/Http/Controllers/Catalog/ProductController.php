<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Product;
use App\Collection;

class ProductController extends Controller
{
	public function show($product_id) {
		$product = Product::where('id', $product_id)
			->with('pictures')
			->with('sizes')
			->with('parameters')
			->with('collection')
			->first();

		if (!$product) {
			$this->template = 'catalog.product-not-found';
			$this->title = 'Товар не найден - Sneakerdark';
			$this->vars['product_article'] = $product_id;
			return $this->output();
		}


		$collection = Collection::find($product->collection->id);
		$this->vars['collectionsChain'] = $collection->chain;


		$product->colors = Product::where('model', $product->model)->with('pictures')->get();

		$this->template = 'catalog.product';
		$this->title = $product->title.' - Sneakerdark';
		$this->ogImage = $product->pictures[0]->src;
		$this->vars['product'] = $product;

		return $this->output();
	}
}
