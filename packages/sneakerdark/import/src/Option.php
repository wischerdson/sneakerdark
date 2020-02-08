<?php

namespace Sneakerdark\Import;

use App\Option as OptionModel;

class Option
{
	public function __construct($xml)
	{
		$options = OptionModel::select('name')->distinct()->pluck('name')->toArray();

		$xml->parseOffer([
			'sku' => 'offer:group_id',
			'name' => 'offer.param:name'
		], function ($data) use (&$options) {
			if (is_null($data['sku'])) {
				return;
			}
			$willBeInsert = [];

			foreach ((array) $data['name'] as $value) {
				// Если данный параметр - атрибут, то ничего не делать
				if (!preg_match('/(р|Р)азмер/i', $value)) {
					continue;
				}
				// Если данная опция уже есть в бд, то ничего не делать
				if (in_array($value, $options)) {
					continue;
				}

				$option = [];
				$option['name'] = $value;

				$options[] = $value;
				$willBeInsert[] = $option;
			}
			OptionModel::insert($willBeInsert);
		});
	}
}