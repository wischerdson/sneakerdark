<?php

namespace Sneakerdark\Import;

use App\ProductAttribute as ProductAttributeModel;

class ProductAttribute {
	public static function create($params, $productId, $existingAttrs) {
		$attributes = [];

		foreach ($params as $paramName => $paramValue) {
			// Если текущий параметр - опция, то пропускаем итерацию
			if (preg_match('/(р|Р)азмер/i', $paramName)) {
				continue;
			}
			$attribute = [];
			$attribute['product_id'] = $productId;
			$attribute['attribute_id'] = $existingAttrs[$paramName];
			$attribute['text'] = $paramValue;
			$attributes[] = $attribute;
		}

		ProductAttributeModel::insert($attributes);
		unset($attributes);
	}
}