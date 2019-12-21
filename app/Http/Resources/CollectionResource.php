<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Collection;
use App\Product;
use App\Parameter;
use App\Size;
use App\Http\Resources\ProductResource;

class CollectionResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request)
	{
		$collectionsIds = Collection::find($this->id)->children;
		$productsIds = Product::
			fetchFromNestedCollections($collectionsIds)
			->withoutGlobalScopes()
			->select('id')
			->distinct()
			->pluck('id');

		$categories = Parameter::
			whereIn('key', ['Вид аксессуаров', 'Футбольная обувь', 'Предмет одежды', 'Категория'])
			->whereIn('product_id', $productsIds)
			->select('value')
			->orderBy('value', 'asc')
			->distinct()
			->pluck('value');

		$gender = Parameter::
			where('key', 'Пол')
			->whereIn('product_id', $productsIds)
			->select('value')
			->distinct()
			->pluck('value');

		$sizes = Size::
			where('instock', '>', 0)
			->whereIn('product_id', $productsIds)
			->select('size')
			->distinct()
			->pluck('size');

		$brands = Product::
			whereIn('id', $productsIds)
			->withoutGlobalScopes()
			->select('vendor')
			->orderBy('vendor', 'asc')
			->distinct()
			->pluck('vendor');

		$prices = Product::
			whereIn('id', $productsIds)
			->withoutGlobalScopes()
			->select('price')
			->orderBy('price', 'asc')
			->distinct()
			->pluck('price')
			->toArray();

		$products = Product::fetchFromNestedCollections($collectionsIds)->with(['pictures', 'sizes'])->paginate(8 * 4, ['*'], 'page', $request->input('page'));

		$pLinks = [];

		for ($i = $products->currentPage()-3; $i <= $products->currentPage()+3; $i++) { 
			if ($i > 1 and $i < $products->lastPage())
				$pLinks[] = $i;
		}

		return [
			'id' => $this->id,
			'parent_id' => $this->parent_id,
			'title' => $this->title,
			'total_products' => count($productsIds),
			'total_subject' => smart_ending(count($productsIds), ['', 'а', 'ов'], 'товар'),
			'products' => ProductResource::collection($products),
			'filters' => [
				'category' => $categories,
				'gender' => $gender,
				'size' => $sizes,
				'brand' => $brands,
				'price_min' => $prices[0],
				'price_max' => end($prices)
			],
			'pagination' => [
				'current_page' => $products->currentPage(),
				'has_more_pages' => $products->hasMorePages(),
				'per_page' => $products->perPage(),
				'last_page' => $products->lastPage(),
				'on_first_page' => $products->onFirstPage(),
				'pages' => $pLinks
			]
		];
	}
}
