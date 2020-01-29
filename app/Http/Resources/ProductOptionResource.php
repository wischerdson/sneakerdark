<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductOptionValueResource;

use App\ProductOptionValue;

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
        return ProductOptionValueResource::collection($this->values);
        return ProductOptionValueResource::collection(ProductOptionValue::where('product_option_id', $this->collection->id));
        return parent::toArray($request);
    }
}
