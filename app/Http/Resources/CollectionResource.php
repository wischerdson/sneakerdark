<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Collection;
use App\Product;
use App\Parameter;
use App\Size;
use App\Http\Resources\ProductResource;
use App\Http\Resources\FiltersResourceCollection;

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
		$collectionIds = $this->children;
		//$products = Product::whereIn('collection_id', $collectionIds)->select('id')->pluck('id')->toArray();

		return new FiltersResourceCollection(Product::whereIn('collection_id', $collectionIds)->select('id')->pluck('id')->toArray());
	}




	/*public function toArray($request)
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
	}*/

	
}
