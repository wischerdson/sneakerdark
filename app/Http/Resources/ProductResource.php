<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\ProductOptionResource;

use App\ProductOption;

class ProductResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request)
	{
		$fields = $request->input('fields') ?? [];

		$result = [
			'id' => $this->id,
			'sku' => $this->sku,
			'image' => asset($this->image),
			'price' => $this->price,
			'url' => route('catalog.product', ['product_alias' => $this->alias])
		];

		foreach ($fields as $field) {
			$result[$field] = $this->fields($field);
		}

		return $result;
	}

	private function fields($field)
	{
		$fields = [
			'name' => function () {
				return $this->description->name;
			},
			'vendor' => function () {
				return $this->description->vendor;
			},
			'sizes' => function () {
				return ProductOptionResource::collection($this->sizes)[0];
			}
		];

		return array_key_exists($field, $fields) ? call_user_func($fields[$field]) : null;
	}
}
