<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Product;

class ProductController extends \App\Http\Controllers\SiteController
{
	public function show($product_id) {
		$product = Product::where('article', $product_id)
			->with('pictures')
			->with('sizes')
			->with('parameters')
			->first();

		if (!$product) {
			$this->template = 'shop.product-not-found';
			$this->title = 'Товар не найден - Sneakerdark';
			$this->vars['product_article'] = $product_id;
			return $this->output();
		}

		$this->template = 'shop.product';
		$this->title = $product->title.' - Sneakerdark';
		$this->vars['product'] = $product;
		return $this->output();
	}
}
