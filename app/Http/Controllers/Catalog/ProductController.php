<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Product;
use App\ProductAttribute;
use App\ProductOption;
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

		$collection = Collection::with('description')->find($product->collection_id);
		$this->vars['collectionsChain'] = $collection->chain;
		
		$product->colors = Product::colors($product->description->model)->get();

		$metaTitle = $product->description->meta_title;
		$price = $product->price.' '.smart_ending($product->price, ['рубль', 'рубля', 'рублей']);
		$metaTitle = str_replace('{{ $price }}', $price, $metaTitle);

		$this->template = 'catalog.product';
		$this->title = $metaTitle;
		$this->ogImage = asset($product->image);
		$this->vars['product'] = $product;

		$gender = ProductAttribute::
			where('product_id', $product->id)->
			join('attribute', 'attribute_id', '=', 'attribute.id')->
			join('attribute_description', 'attribute.id', '=', 'attribute_description.attribute_id')->
			where('name', 'Пол')->
			first();

		$type = ProductOption::
			where('product_id', $product->id)->
			where('name', 'like', '%размер%')->
			first();

		$sizeChart = '';

		if ($gender and $type) {
			if ($gender->text == 'Женский' and $type->name == 'Размер одежды') {
				$sizeChart = 'size_chart_women_clothing';
			}
		}

		$this->vars['sizeChart'] = $sizeChart;


		return $this->output();
	}
}
