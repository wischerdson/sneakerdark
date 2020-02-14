<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\ProductOptionResource;
use App\Http\Resources\ProductResource;
use App\Product;
use App\ProductOption;
use App\CustomerCartOption;

class CartResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request)
	{
		$customerCartOption = CustomerCartOption::
			where('customer_cart_id', $this->id)->
			select('product_option_id')->
			pluck('product_option_id')->
			toArray();

		if (!empty($customerCartOption)) {
			$option = ProductOption::find($customerCartOption);
		}

		$product = Product::with('description')->find($this->product_id);
		
		return [
			'id' => $this->id,
			'option' => ProductOptionResource::collection($option ?? []),
			'quantity' => $this->quantity,
			'created_at' => $this->created_at,
			'product' => new ProductResource($product)
		];
	}
}
