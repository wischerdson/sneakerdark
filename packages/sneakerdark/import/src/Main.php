<?php

namespace Sneakerdark\Import;

use Sneakerdark\XmlParser\Document as XmlParser;

class Main
{
	private $productInstock = [];

	public function __construct($file, $console)
	{
		$stopwatch = time();
		$console->info('Preparing data...');
		$this->generalInformation($file);

		$xml = new XmlParser($file);
		$console->info('Importing collections...');
		new Collection($xml);
		$console->info('Importing attributes...');
		new Attribute($xml);
		$console->info('Importing options...');
		new Option($xml);
		$xml->start();
		unset($xml);

		$xml = new XmlParser($file);
		$console->info('Importing products...');
		new Product($xml, $this->productInstock);
		$xml->start();
		unset($xml);

		$xml = new XmlParser($file);
		$console->info('Importing products options...');
		new ProductOption($xml);
		$xml->start();
		unset($xml);

		$timeDiff = time() - $stopwatch;
		$timeDiffM = floor($timeDiff/60);
		$timeDiffS = $timeDiff - $timeDiffM*60;
		$console->line('Execution time - '.$timeDiffM.'m '.$timeDiffS.'s');
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

		/*$xml->parseOffer([
			'sku1' => 'offer:group_id',
			'sku2' => 'offer:id',
			'name' => 'offer.param:name',
			'value' => 'offer.param'
		], function ($data) {
			$this->attributesInfo($data);
		});*/

		$xml->start();
	}

	private function productsInfo($data)
	{
		$data['sku'] = $data['sku1'] ?? $data['sku2'];
		$data['instock'] = (int) $data['instock'];

		if (array_key_exists($data['sku'], $this->productInstock)) {
			$this->productInstock[$data['sku']] += $data['instock'];
		} else {
			$this->productInstock[$data['sku']] = $data['instock'];
		}
	}

	/*private function attributesInfo($data)
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
	}*/
}
