<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
		return [
			'id' => $this->id,
			'parent_id' => $this->parent_id,
			'title' => $this->title,
			'products' => ProductResource::collection($this->products),
			'filters' => [
				'category' => 1,
				'gender' => 1,
				'size' => 1,
				'model' => 1,
				'color' => 1,
				'price_min' => 1,
				'price_max' => 1
			],
			'pagination' => [
				'123' => 'asd'
			]
		];
	}
}
