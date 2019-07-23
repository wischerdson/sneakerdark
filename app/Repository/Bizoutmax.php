<?php

namespace App\Repository;

use Carbon\Carbon;

class Bizoutmax
{
	private $yml_file;
	private $products;

	public function __construct() {
		$this->yml_file = $this->get_yml_file();

		$products = $this->yml_file->shop->offers->offer;
		$result = [];
		foreach ($products as $product) {
			$precessed_params = $this->get_attr_params($product);
			$reserved = [
				'group_id' => $product['group_id']
			];
			$product_a = (array) $product;
			$product_a['param'] = $precessed_params;

			foreach ($reserved as $key => $value) {
				$product_a[$key] = $value;
			}
			array_push($result, (object) $product_a);
		}
		$this->products = $result;
	}
	private function get_yml_file() {
		$yml = cache()->remember('YML_FILE', Carbon::now()->addMinutes(30), function () {
			return (string) file_get_contents(config('app.import_link'));
		});
		return simplexml_load_string($yml);
	}
	public function get_products() {
		return $this->products;
	}
	public function get_unique_products($products) {
		$products_a = $products;
		$ex_ids = [];
		$result = [];
		foreach ($products_a as $product) {
			$product = (array) $product;
			$group_id = (string) $product['group_id'];
			if (in_array($group_id, $ex_ids)) continue;
			array_push($ex_ids, $group_id);
			$result[$group_id] = $product;
		}
		return (object) $result;
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
	public function whereParameter($parameter, $string, $products) {
		$results = [];
		foreach ($products as $product) {
			$parameters = $product->param[$parameter];
			foreach ($parameters as $value) {
				if ($string == $value)
					array_push($results, $product);
			}
		}
		return $results;
	}
	public function get_by_group_id($id) {
		$results = [];
		foreach ($this->get_products() as $product) {
			if ((string) $product['group_id'] == (string) $id)
				array_push($results, $product);
		}
		return $results;
	}
}