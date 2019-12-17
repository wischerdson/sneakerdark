<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
		return [
			'id' => $this->id,
			'title' => $this->title,
			'price' => $this->price,
			'collection_id' => $this->collection_id,
			'pictures' => $this->pictures,
			'vendor' => $this->vendor
		];
		return parent::toArray($request);
	}
}
