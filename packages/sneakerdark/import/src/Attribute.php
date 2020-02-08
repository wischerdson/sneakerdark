<?php

namespace Sneakerdark\Import;

use App\Attribute as AttributeModel;

class Attribute
{
	public function __construct($productsInfo, $xml)
	{
		$attributes = AttributeModel::select('name')->distinct()->pluck('name')->toArray();
		$buffer = [];

		$xml->parseOffer([
			'sku1' => 'offer:group_id',
			'sku2' => 'offer:id',
			'name' => 'offer.param:name',
			'value' => 'offer.param'
		], function ($data) use (&$attributes, &$buffer, $productsInfo) {
			$data['sku'] = $data['sku1'] ?? $data['sku2'];

			foreach ((array) $data['name'] as $key1 => $value) {
				// Если данный параметр - опция, то ничего не делать
				if (array_key_exists($value, $productsInfo[$data['sku']]['options'])) {
					continue;
				}
				// Если данный атрибут уже есть в бд, то ничего не делать
				if (in_array($value, $attributes)) {
					continue;
				}

				$attribute = new AttributeModel;
				$attribute->name = $value;
				$attribute->save();

				$attributes[] = $value;
			}
		});
	}
}