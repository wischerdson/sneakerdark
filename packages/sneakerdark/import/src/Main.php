<?php

namespace Sneakerdark\Import;

use Sneakerdark\XmlParser\Document as XmlParser;

class Main
{
	private $collection = 0;
	private $product = [];
	private $image = [
		'count' => 0,
		'tmpProducts' => []
	];
	private $attribute;
	private $option;

	public function __construct($file, $console = null)
	{
		$this->generalInformation($file);
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

		$xml->parseCategory([], function ($data) {
			$this->collectionsInfo($data);
		});

		$xml->start();

		$this->image = $this->image['count'];

		dump($this->collection);
	}

	private function productsInfo($data)
	{
		$data['sku'] = $this->getSku($data);
		$data['instock'] = (int) $data['instock'];

		if (array_key_exists($data['sku'], $this->product)) {
			$this->product[$data['sku']] += $data['instock'];
		} else {
			$this->product['count'] = empty($this->product) ? 1 : $this->product['count'] + 1;
			$this->product[$data['sku']] = $data['instock'];
		}
	}

	private function imagesInfo($data)
	{
		$data['sku'] = $this->getSku($data);

		if (!in_array($data['sku'], $this->image['tmpProducts'])) {
			$this->image['tmpProducts'][] = $data['sku'];
			$this->image['count'] += count((array) $data['images']);
		}
	}

	private function collectionsInfo($data)
	{
		$this->collection++;
	}

	private function getSku($data)
	{
		return $data['sku1'] ?? $data['sku2'];
	}
}
