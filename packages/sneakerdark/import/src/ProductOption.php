<?php

namespace Sneakerdark\Import;

use App\ProductOption as ProductOptionModel;
use App\Product;
use App\Option;

class ProductOption {
	public function __construct($xml) {
		$options = Option::select('name', 'id')->pluck('id', 'name')->toArray();

		$products = Product::select('id', 'sku')->pluck('id', 'sku')->toArray();

		$xml->parseOffer([
			'sku' => 'offer:group_id',
			'name' => 'offer.param:name',
			'value' => 'offer.param',
			'instock' => 'offer.outlets.outlet:instock'
		], function ($data) use ($products, $options) {
			if (is_null($data['sku'])) {
				return;
			}

			$params = array_combine((array) $data['name'], (array) $data['value']);

			foreach ($params as $paramName => $paramValue) {
				// Если текущий параметр - атрибут, то пропускаем итерацию
				if (!preg_match('/(р|Р)азмер/i', $paramName)) {
					continue;
				}
				ProductOptionModel::updateOrCreate(
				    ['value' => $paramValue, 'product_id' => $products[$data['sku']]],
				    ['instock' => $data['instock'], 'option_id' => $options[$paramName]]
				);
			}
		});
	}
}