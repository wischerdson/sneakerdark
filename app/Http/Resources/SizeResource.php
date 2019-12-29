<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SizeResource extends JsonResource
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
			'size' => $this->size,
			'product_id' => $this->product_id,
			'instock' => $this->instock,
			'updated_at' => $this->updated_at
        ];
	}
}
