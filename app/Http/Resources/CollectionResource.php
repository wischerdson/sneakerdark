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
		$filters = json_decode($request->input('filters'));

		$collectionsIds = Collection::find($this->id)->children;
		$productsIds = Product::
			whereIn('collection_id', $collectionsIds)
			->withoutGlobalScopes()
			->select('id')
			->distinct()
			->pluck('id')
			->toArray();

		$filteredProductsIds = $productsIds;

		if (!empty($filters->category)) {
			$filteredProductsIds = Parameter::
				whereIn('value', $filters->category)
				->select('product_id')
				->pluck('product_id')
				->toArray();
		}
		if (!empty($filters->gender)) {
			$filteredProductsIds = array_intersect(
				Parameter::
					whereIn('value', $filters->gender)
					->select('product_id')
					->pluck('product_id')
					->toArray(),
				$filteredProductsIds
			);
		}
		if (!empty($filters->size)) {
			$filteredProductsIds = array_intersect(
				Size::
					whereIn('size', $filters->size)
					->where('instock', '!=', 0)
					->select('product_id')
					->pluck('product_id')
					->toArray(),
				$filteredProductsIds
			);
		}
		if (!empty($filters->brand)) {
			$filteredProductsIds = array_intersect(
				Product::
					whereIn('vendor', $filters->brand)
					->withoutGlobalScopes()
					->select('id')
					->pluck('id')
					->toArray(),
				$filteredProductsIds
			);
		}

		$filteredProductsIds = array_intersect(
			Product::
				where('price', '>=', $filters->price[0] ?? 0)
				->where('price', '<=', $filters->price[1] ?? 1000000000)
				->withoutGlobalScopes()
				->select('id')
				->pluck('id')
				->toArray(),
			$filteredProductsIds
		);

		$filterList = $request->input('attach_filter_list') ? $this->composeFilterList($productsIds) : [];

		
		$productsIds = array_intersect($productsIds, $filteredProductsIds);

		$products = Product::
			whereIn('id', $productsIds)
			->with(['pictures', 'sizes'])
			->paginate(8 * 4, ['*'], 'page', $request->input('page'));

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
			'filter_list' => $filterList,
			're' => $request->input('attach_filter_list'),
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

	private function composeFilterList($productsIds) {
		$result = [];
		$result['category'] = Parameter::
			whereIn('key', ['Вид аксессуаров', 'Футбольная обувь', 'Предмет одежды', 'Категория'])
			->whereIn('product_id', $productsIds)
			->select('value')
			->orderBy('value', 'asc')
			->distinct()
			->pluck('value');

		$result['gender'] = Parameter::
			where('key', 'Пол')
			->whereIn('product_id', $productsIds)
			->select('value')
			->distinct()
			->pluck('value');

		$result['size'] = Size::
			where('instock', '>', 0)
			->whereIn('product_id', $productsIds)
			->where('instock', '!=', 0)
			->select('size')
			->distinct()
			->pluck('size');

		$result['brand'] = Product::
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

		$result['price'] = [];
		$result['price'][0] = $prices[0];
		$result['price'][1] = end($prices);

		return $result;
	}
}
