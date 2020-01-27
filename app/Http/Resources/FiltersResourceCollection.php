<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\AttributeDescription;
use App\Product;
use App\ProductDescription;
use App\ProductAttribute;
use App\ProductOption;
use App\ProductOptionValue;

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

		$filteredProductsIds = $this->filterProducts($request);
		$count = count($filteredProductsIds);

		$result = [
			'count' => $count,
			'subject' => smart_ending($count, ['товар', 'товара', 'товаров']),
			'filters' => [],
			'products' => ProductResource::collection(Product::whereIn('id', $filteredProductsIds)->get())
		];
		foreach ($filtersFields as $field) {
			$result['filters'][$field] = $this->getSection($field);
		}

		return $result;
	}

	private function filterProducts($request)
	{
		$appliedFilters = $request->input('applied_filters') ?? [];
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
				return;
			},
			'size' => function ($filter) {
				return;
			},
			'price' => function ($filter) {
				return;
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
					$optionsIds = ProductOption::
						whereIn('product_id', $this->collection)->
						whereIn('name', [
							'Размер обуви',
			                'Размер одежды',
			                'Размер Аксессуаров'
						])->
						pluck('id')->
						toArray();

					return ProductOptionValue::
						whereIn('product_option_id', $optionsIds)->
						where('instock', '>', 0)->
						select('value')->
						distinct()->
						pluck('value')->
						sort()->
						toArray();;
				}
			],
			'price' => [
				'title' => 'Цена',
				'action' => function () {
					return [
						'min' => Product::
							orderBy('price', 'ASC')->
							select('price')->
							first()
							->price,
						'max' => Product::
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
		$attributesIds = AttributeDescription::whereIn('name', $attributes)->pluck('id')->toArray();
		return ProductAttribute::
			whereIn('attribute_id', $attributesIds)->
			whereIn('product_id', $this->collection)->
			select('text')->
			orderBy('text', 'asc')->
			distinct()->
			pluck('text');
	}
}
