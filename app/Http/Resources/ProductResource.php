<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
	private const FIELDS = [
		'name' => [
			'with' => 'description',
			'column' => 'name'
		],
		'vendor' => [
			'with' => 'description',
			'column' => 'vendor'
		]
	];

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
			if (!array_key_exists($field, self::FIELDS))
				continue;

			$rule = self::FIELDS[$field];
			if (array_key_exists('column', $rule))
				$result[$field] = $this->{$rule['with']}->{$rule['column']} ?? null;
			else if (array_key_exists('collection', $rule))
				$result[$field] = $rule['collection']::collection($this->{$rule['with']}) ?? null;
		}

		return $result;
	}
}
