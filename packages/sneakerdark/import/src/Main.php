<?php

namespace Sneakerdark\Import;

use Sneakerdark\XmlParser\Document as XmlParser;

class Main
{
	private $product = [];
	private $image = [
		'count' => 0,
		'tmpProducts' => []
	];
	private $attribute;
	private $option;

	public function __construct($file, $console)
	{
		$stopwatch = time();
		$console->info('Preparing data...');
		$this->generalInformation($file);

		$xml = new XmlParser($file);
		$console->info('Importing collections...');
		new Collection([], $xml);
		$console->info('Importing attributes...');
		new Attribute($this->product, $xml);
		$xml->start();
		unset($xml);

		$timeDiff = time() - $stopwatch;
		$timeDiffM = floor($timeDiff/60);
		$timeDiffS = $timeDiff - $timeDiffM*60;
		$console->line('Execution time - '.$timeDiffM.'m '.$timeDiffS.'s');

		/*$xml = new XmlParser($file);
		new Product($this->product, $xml);
		unset($xml);*/
	}

	private function generalInformation($file)
	{
		$xml = new XmlParser($file);

		$xml->parseOffer([
			'sku1' => 'offer:group_id',
			'sku2' => 'offer:id',
			'instock' => 'offer.outlets.outlet:instock'
		], function ($data) {
			$this->productsInfo($data);
		});

		$xml->parseOffer([
			'sku1' => 'offer:group_id',
			'sku2' => 'offer:id',
			'images' => 'offer.picture'
		], function ($data) {
			$this->imagesInfo($data);
		});

		$xml->parseOffer([
			'sku1' => 'offer:group_id',
			'sku2' => 'offer:id',
			'name' => 'offer.param:name',
			'value' => 'offer.param'
		], function ($data) {
			$this->attributesInfo($data);
		});

		$xml->start();

		$this->image = $this->image['count'];
	}

	private function productsInfo($data)
	{
		$data['sku'] = $data['sku1'] ?? $data['sku2'];
		$data['instock'] = (int) $data['instock'];

		if (array_key_exists($data['sku'], $this->product)) {
			$this->product[$data['sku']]['variations']++;
			$this->product[$data['sku']]['instock'] += $data['instock'];
		} else {
			$this->product[$data['sku']] = [
				'variations' => 1,
				'instock' => $data['instock']
			];
		}
	}

	private function imagesInfo($data)
	{
		$data['sku'] = $data['sku1'] ?? $data['sku2'];

		if (!in_array($data['sku'], $this->image['tmpProducts'])) {
			$this->image['tmpProducts'][] = $data['sku'];
			$this->image['count'] += count((array) $data['images']);
		}
	}

	private function attributesInfo($data)
	{
		$data['sku'] = $data['sku1'] ?? $data['sku2'];
		// Если данный товар не имеет опций, то прекратить выполнение функции
		if (is_null($data['sku1'])) {
			$this->product[$data['sku']]['options'] = [];
			return;
		}
		$options = array_combine((array) $data['name'], (array) $data['value']);

		// Если у данного товара еще не установились параметры, то установим их и прекратим выполнение функции
		if (!isset($this->product[$data['sku']]['options'])) {
			$this->product[$data['sku']]['options'] = $options;
			return;
		}

		// Определим, является ли параметр опцией
		$this->product[$data['sku']]['options'] = array_diff($options, $this->product[$data['sku']]['options']);
		return;
		foreach ($data['name'] as $key => $value) {
			if (!isset($this->product[$data['sku']]['options'][$value]))
				return;

			// Если значение параметра прошлой вариации товара изменилось, значит это опция, иначе - атрибут
			if ($this->product[$data['sku']]['options'][$value] == $data['value'][$key]) {
				unset($this->product[$data['sku']]['options'][$value]);
			}
		}
	}
}
