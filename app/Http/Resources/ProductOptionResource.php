<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductOptionValueResource;

use App\Option;

class ProductOptionResource extends JsonResource
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
			'name' => Option::find($this->option_id)->name,
			'value' => $this->value,
			'instock' => $this->instock
		];
	}
}
