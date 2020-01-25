<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\ProductResource;

class SearchResourceCollection extends ResourceCollection
{
	/**
	 * Transform the resource collection into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function toArray($request)
	{
		$offset = $request->input('offset') ?? 0;
		$limit = $request->input('limit') ?? 9;
		$limit = min($limit, 200);

		$count = $this->collection->count();
		$products = $this->collection->slice($offset, $limit);
		
		return [
			'count' => $count,
			'subject' => smart_ending($count, ['результат', 'результата', 'результатов']),
			'products' => ProductResource::collection($products)
		];
	}
}
