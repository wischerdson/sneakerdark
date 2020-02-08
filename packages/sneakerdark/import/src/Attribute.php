<?php

namespace Sneakerdark\Import;

use App\Attribute as AttributeModel;

class Attribute
{
	public function __construct($xml)
	{
		$attributes = AttributeModel::select('name')->distinct()->pluck('name')->toArray();

		$xml->parseOffer([
			'sku1' => 'offer:group_id',
			'sku2' => 'offer:id',
			'name' => 'offer.param:name'
		], function ($data) use (&$attributes) {
			$data['sku'] = $data['sku1'] ?? $data['sku2'];
			$willBeInsert = [];

			foreach ((array) $data['name'] as $value) {
				// Если данный параметр - опция, то ничего не делать
				if (preg_match('/(р|Р)азмер/i', $value)) {
					continue;
				}
				// Если данный атрибут уже есть в бд, то ничего не делать
				if (in_array($value, $attributes)) {
					continue;
				}

				$attribute = [];
				$attribute['name'] = $value;

				$attributes[] = $value;
				$willBeInsert[] = $attribute;
			}
			AttributeModel::insert($willBeInsert);
		});
	}
}