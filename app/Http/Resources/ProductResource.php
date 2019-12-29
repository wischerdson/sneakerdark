<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\SizeResource;
use App\Http\Resources\PictureResource;

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
			'pictures' => PictureResource::collection($this->pictures),
			'sizes' => SizeResource::collection($this->sizes),
			'vendor' => $this->vendor,
			'url' => route('catalog.product', ['product_id' => $this->id])
		];
	}
}
