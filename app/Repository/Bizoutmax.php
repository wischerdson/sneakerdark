<?php

namespace App\Repository;

use Carbon\Carbon;

class Bizoutmax
{
	private $yml_file;

	public function __construct() {
		$this->yml_file = $this->get_yml_file();
		return $this;
	}
	private function get_yml_file() {
		$yml = cache()->remember('YML_FILE', Carbon::now()->addMinutes(30), function () {
			return (string) file_get_contents(config('app.import_link'));
		});
		return simplexml_load_string($yml);
	}
	public function get_products() {
		$products = $this->yml_file->shop->offers->offer;
		foreach ($products as $key => $value) {
			$products['param'] = $this->get_attr_params($products[$key]);
		}
		return;
	}
	public function get_attr_params($product) {
		$params = [];
		foreach ($product->param as $key => $value) {
			$parameterName = (string) $value['name'];
			if (!isset($params[$parameterName]))
				$params[$parameterName] = [];
			array_push($params[$parameterName], (string) $value);
		}
		return $params;
	}
	public function like($parameter, $string, $products, $case_sensitive = false) {
		return $products;
	}
	public function whereParameter($parameter, $string, $products) {
		$results = [];
		foreach ($products as $value) {
			if ($this->get_attr_params($value)[$parameter] === $string)
				array_push($results, $value);
		}
		return $results;
	}
	public function get_by_group_id($id) {
		foreach ($this->get_products() as $product) {
			if ((string) $product['group_id'] == (string) $id)
				return $product;
		}
	}
}