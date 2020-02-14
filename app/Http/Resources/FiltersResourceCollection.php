<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Attribute;
use App\Option;
use App\Product;
use App\ProductDescription;
use App\ProductAttribute;
use App\ProductOption;

class FiltersResourceCollection extends ResourceCollection
{
	/**
	 * Transform the resource collection into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request)
	{
		$filtersFields = $request->input('filters_fields') ?? [];
		$sort = $request->input('sort') ?? ['column' => 'created_at', 'mode' => 'desc'];
		$sort = is_string($sort) ? json_decode($sort) : $sort;
		$sort = (object) $sort;
		
		$filteredProductsIds = $this->filterProducts($request);
		$count = count($filteredProductsIds);

		$products = Product::
			whereIn('id', $filteredProductsIds)->
			where('instock', '>', 0)->
			orderBy($sort->column, $sort->mode)->
			paginate(10 * 3, ['*'], 'page', $request->input('page'));

		$pLinks = [];
		for ($i = $products->currentPage()-3; $i <= $products->currentPage()+3; $i++) { 
			if ($i > 1 and $i < $products->lastPage())
				$pLinks[] = $i;
		}

		$result = [
			'count' => $count,
			'subject' => smart_ending($count, ['товар', 'товара', 'товаров']),
			'filters' => [],
			'products' => ProductResource::collection($products),
			'pagination' => [
				'current_page' => $products->currentPage(),
				'has_more_pages' => $products->hasMorePages(),
				'per_page' => $products->perPage(),
				'last_page' => $products->lastPage(),
				'on_first_page' => $products->onFirstPage(),
				'pages' => $pLinks
			]
		];
		foreach ($filtersFields as $field) {
			$result['filters'][$field] = $this->getSection($field);
		}

		return $result;
	}

	private function filterProducts($request)
	{
		$appliedFilters = $request->input('applied_filters') ?? [];
		if (is_string($appliedFilters))
			$appliedFilters = json_decode($appliedFilters);
		$filteredProductsIds = $this->collection->toArray();

		foreach ($appliedFilters as $filterField => $filter) {
			$filteredProductsIds = array_intersect($this->filterBySection($filterField, $filter), $filteredProductsIds);
		}

		return $filteredProductsIds;
	}

	private function filterBySection($section, $filter)
	{
		$sections = [
			'category' => function ($filter) {
				return ProductAttribute::whereIn('text', $filter)->pluck('product_id');
			},
			'gender' => function ($filter) {
				return ProductAttribute::whereIn('text', $filter)->pluck('product_id');
			},
			'season' => function ($filter) {
				return ProductAttribute::whereIn('text', $filter)->pluck('product_id');
			},
			'color' => function ($filter) {
				return ProductAttribute::whereIn('text', $filter)->pluck('product_id');
			},
			'model' => function ($filter) {
				return ProductAttribute::whereIn('text', $filter)->pluck('product_id');
			},
			'brand' => function ($filter) {
				return ProductDescription::whereIn('vendor', $filter)->pluck('product_id');
			},
			'size' => function ($filter) {
				return ProductOption::whereIn('value', $filter)->where('instock', '>', 0)->pluck('product_id');
			},
			'price' => function ($filter) {
				return Product::
					where('price', '>=', $filter[0])->
					where('price', '<=', $filter[1])->
					where('deleted_at', null)->
					pluck('id');
			}
		];

		if (!array_key_exists($section, $sections) || empty($filter))
			return $this->collection->toArray();

		return call_user_func($sections[$section], $filter)->toArray();
	}

	private function getSection($section)
	{
		$sections = [
			'category' => [
				'title' => 'Категория',
				'action' => function () {
					return $this->distinctByAttributes([
						'Вид аксессуаров',
						'Футбольная обувь',
						'Предмет одежды',
						'Категория'
					]);
				}
			],
			'gender' => [
				'title' => 'Пол',
				'action' => function () {
					return $this->distinctByAttributes(['Пол']);
				}
			],
			'season' => [
				'title' => 'Сезон',
				'action' => function () {
					return $this->distinctByAttributes(['Сезон']);
				}
			],
			'color' => [
				'title' => 'Цвет',
				'action' => function () {
					return $this->distinctByAttributes(['Цвет']);
				}
			],
			'model' => [
				'title' => 'Модель',
				'action' => function () {
					return $this->distinctByAttributes(['Модель']);
				}
			],
			'brand' => [
				'title' => 'Бренд',
				'action' => function () {
					return ProductDescription::
						whereIn('product_id', $this->collection)->
						select('vendor')->
						orderBy('vendor', 'asc')->
						distinct()->
						pluck('vendor');
				}
			],
			'size' => [
				'title' => 'Размер',
				'action' => function () {
					$optionsIds = Option::
						whereIn('name', [
							'Размер обуви',
			                'Размер одежды',
			                'Размер Аксессуаров'
						])->
						pluck('id')->
						toArray();

					return ProductOption::
						whereIn('option_id', $optionsIds)->
						whereIn('product_id', $this->collection)->
						where('instock', '>', 0)->
						select('value')->
						distinct()->
						pluck('value')->
						sort()->
						toArray();
				}
			],
			'price' => [
				'title' => 'Цена',
				'action' => function () {
					return [
						'min' => Product::
							whereIn('id', $this->collection)->
							where('deleted_at', null)->
							orderBy('price', 'ASC')->
							select('price')->
							first()
							->price,
						'max' => Product::
							whereIn('id', $this->collection)->
							where('deleted_at', null)->
							orderBy('price', 'DESC')->
							select('price')->
							first()
							->price
					];
				}
			]
		];

		if (!array_key_exists($section, $sections))
			return null;

		return [
			'title' => $sections[$section]['title'],
			'resource' => call_user_func($sections[$section]['action'])
		];
	}

	private function distinctByAttributes($attributes)
	{
		$attributesIds = Attribute::whereIn('name', $attributes)->pluck('id')->toArray();
		return ProductAttribute::
			whereIn('attribute_id', $attributesIds)->
			whereIn('product_id', $this->collection)->
			select('text')->
			orderBy('text', 'asc')->
			distinct()->
			pluck('text');
	}
}
