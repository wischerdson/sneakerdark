<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Product;
use App\Collection;

class ProductController extends Controller
{
	public function show($product_alias) {
		$product = Product::where('alias', $product_alias)->withAttributes()->withOptions()->with([
			'description',
			'images'
		])->first();

		if (!$product) {
			$this->template = 'catalog.product-not-found';
			$this->title = 'Товар не найден - Sneakerdark';
			return $this->output();
		}

		$collection = Collection::find($product->collection_id);
		$this->vars['collectionsChain'] = $collection->chain;


		$product->colors = Product::colors($product->description->model)->get();

		$metaTitle = $product->description->meta_title;
		$price = $product->price.' '.smart_ending($product->price, ['рубль', 'рубля', 'рублей']);
		$metaTitle = str_replace('{{ $price }}', $price, $metaTitle);

		$this->template = 'catalog.product';
		$this->title = $metaTitle;
		$this->ogImage = asset($product->image);
		$this->vars['product'] = $product;

		return $this->output();
	}
}
