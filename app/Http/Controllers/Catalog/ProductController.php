<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Product;
use App\Collection;

class ProductController extends \App\Http\Controllers\SiteController
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


		

		$collectionsChain = [];
		$collectionParentId = $product->collection->id;
		while ($collectionParentId) {
			$collection = Collection::find($collectionParentId);
			array_push($collectionsChain, $collection);
			$collectionParentId = $collection->parent_id;
		}
		$collectionsChain = array_reverse($collectionsChain);

		$product->colors = Product::where('model', $product->model)->with('pictures')->get();

		//dd($product);

		$this->template = 'catalog.product';
		$this->title = $product->title.' - Sneakerdark';
		$this->ogImage = $product->pictures[0]->src;
		$this->vars['product'] = $product;
		$this->vars['categoriesChain'] = $collectionsChain;
		return $this->output();
	}
}
