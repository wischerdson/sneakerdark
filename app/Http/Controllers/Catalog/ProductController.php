<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Product;
use App\Category;

class ProductController extends \App\Http\Controllers\SiteController
{
	public function show($product_id) {
		$product = Product::where('id', $product_id)
			->with('pictures')
			->with('sizes')
			->with('parameters')
			->with('category')
			->first();

		if (!$product) {
			$this->template = 'catalog.product-not-found';
			$this->title = 'Товар не найден - Sneakerdark';
			$this->vars['product_article'] = $product_id;
			return $this->output();
		}


		

		$categoriesChain = [];
		$categoryParentId = $product->category->id;
		while ($categoryParentId) {
			$category = Category::find($categoryParentId);
			array_push($categoriesChain, $category);
			$categoryParentId = $category->parent_id;
		}
		$categoriesChain = array_reverse($categoriesChain);

		$product->colors = Product::where('model', $product->model)->with('pictures')->get();

		//dd($product);

		$this->template = 'catalog.product';
		$this->title = $product->title.' - Sneakerdark';
		$this->vars['product'] = $product;
		$this->vars['categoriesChain'] = $categoriesChain;
		return $this->output();
	}
}
