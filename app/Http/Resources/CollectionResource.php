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
		$sort = json_decode($request->input('sort'));

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
			->orderBy($sort->column, $sort->mode)
			->paginate(10 * 3, ['*'], 'page', $request->input('page'));

		$pLinks = [];

		for ($i = $products->currentPage()-3; $i <= $products->currentPage()+3; $i++) { 
			if ($i > 1 and $i < $products->lastPage())
				$pLinks[] = $i;
		}

		return [
			'id' => $this->id,
			'title' => $this->title,
			'total' => count($productsIds),
			'total_subject' => smart_ending(count($productsIds), ['', 'а', 'ов'], 'товар'),
			'products' => ProductResource::collection($products),
			'filters' => $filterList,
			'r' => $sort,
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

		$result['category'] = [
			'title' => 'Категория',
			'list' => Parameter::
				whereIn('key', ['Вид аксессуаров', 'Футбольная обувь', 'Предмет одежды', 'Категория'])
				->whereIn('product_id', $productsIds)
				->select('value')
				->orderBy('value', 'asc')
				->distinct()
				->pluck('value')
		];

		$result['gender'] = [
			'title' => 'Пол',
			'list' => Parameter::
				where('key', 'Пол')
				->whereIn('product_id', $productsIds)
				->select('value')
				->distinct()
				->pluck('value')
		];

		$result['size'] = [
			'title' => 'Размер',
			'list' => Size::
				where('instock', '>', 0)
				->whereIn('product_id', $productsIds)
				->where('instock', '!=', 0)
				->select('size')
				->distinct()
				->pluck('size')
		];

		$result['brand'] = [
			'title' => 'Бренд',
			'list' => Product::
				whereIn('id', $productsIds)
				->withoutGlobalScopes()
				->select('vendor')
				->orderBy('vendor', 'asc')
				->distinct()
				->pluck('vendor')
		];

		$prices = Product::
			whereIn('id', $productsIds)
			->withoutGlobalScopes()
			->select('price')
			->orderBy('price', 'asc')
			->distinct()
			->pluck('price')
			->toArray();
		
		$result['price'] = [
			'title' => 'Цена',
			'min' => $prices[0],
			'max' => end($prices)
		];

		return $result;
	}
}
