<?php

namespace App\Helpers;

use App;

use App\Category;
use App\Product;
use App\Size;
use App\Picture;
use App\Parameter;

class Bizoutmax {
	private $xmlFilePath;
	private $currentProduct;
	private $productExists = false;
	private $productsIds = [];
	private $sizesPerOffer = 0;
	public $hash = '';

	public function __construct() {
		$this->xmlFilePath = $this->downloadYml(config('app.import_link'));
	}
	private function downloadYml($url) {
		$path = storage_path('app/bizoutmax/').'import.xml';
		file_put_contents($path, '');

		$file = fopen($path, 'w');

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_FILE, $file);
		$data = curl_exec($curl);
		curl_close($curl);

		$this->hash = hash_file('md5', $path);

		print $this->hash."\n";

		fclose($file);

		return $path;
	}
	public function import($tables) {
		$xmlParser = App::make(\App\Helpers\XmlParser::class);

		$xmlParser->category(function ($data) use ($tables) {
			foreach ($tables['category'] as $table) {
				$this->{'import'.ucfirst($table)}($data);
			}
		});

		$xmlParser->offer(function ($data) use ($tables) {
			if ($this->currentProduct != (string) $data->VENDORCODE) {
				$this->currentProduct = (string) $data->VENDORCODE;
				$this->productsIds[(string) $data->VENDORCODE] = [];
				$this->productExists = Product::where('id', (string) $data->VENDORCODE)->exists();
			}

			foreach ($tables['offer'] as $table) {
				$this->{'import'.ucfirst($table)}($data);
			}
		});

		$xmlParser->start($this->xmlFilePath);
	}
	private function importProducts($data) {
		$article = (string) $data->VENDORCODE;

		if (in_array('1', $this->productsIds[$article])) return;
		array_push($this->productsIds[$article], '1');

		if ($this->productExists) {
			Product::where('id', $article)->update(['price' => $data->PRICE]);
			return;
		}

		$description = $data->DESCRIPTION;
		$description = preg_replace('/&lt;/', '<', $description);
		$description = preg_replace('/&gt;/', '>', $description);
		$description = preg_replace('/&amp;/', '&', $description);
		$description = preg_replace('/ style=".*?"/', '', $description);

		Product::create([
			'id' => $article,
			'title' => $data->NAME,
			'price' => $data->PRICE,
			'bizoutmax_url' => $data->URL,
			'category_id' => $data->CATEGORYID,
			'model' => $data->MODEL,
			'description' => $description,
			'vendor' => $data->VENDOR
		]);
	}
	private function importParameters($data) {
		$article = (string) $data->VENDORCODE;

		if (in_array('2', $this->productsIds[$article])) return;
		array_push($this->productsIds[$article], '2');
		if ($this->productExists) return;

		$i = 0;

		foreach ($data->PARAM as $key => $value) {
			if (preg_match('/Размер/', $value['name'], $matches)) continue;

			Parameter::updateOrCreate(
				['id' => $article.$i],
				[
					'product_id' => $article,
					'key' => $value['name'],
					'value' => $value[0]
				]
			);
			$i++;
		}
	}
	private function importPictures($data) {
		$article = (string) $data->VENDORCODE;

		if (in_array('3', $this->productsIds[$article])) return;
		array_push($this->productsIds[$article], '3');

		if ($this->productExists) return;

		$i = 0;

		foreach ($data->PICTURE as $key => $picture) {
			Picture::updateOrCreate(
				['id' => $article.$i],
				[
					'product_id' => $article,
					'bizoutmax_src' => str_ireplace('http:', 'https:', (string) $picture)
				]
			);
			$i++;
		}
	}
	private function importSizes($data) {
		$article = (string) $data->VENDORCODE;

		foreach ($data->PARAM as $key => $value) {
			if (!preg_match('/Размер/', $value['name'])) continue;

			if (in_array('4', $this->productsIds[$article]))
				$this->sizesPerOffer++;
			else {
				$this->sizesPerOffer = 0;
				array_push($this->productsIds[$article], '4');
			}

			if (!$this->productExists and !in_array('1', $this->productsIds[$article])) return;

			Size::updateOrCreate(
				['id' => $article.$this->sizesPerOffer],
				[
					'product_id' => $article,
					'size' => (string) $value,
					'instock' => $data->OUTLETS->OUTLET[0]['instock'] < 0 ? 0 : $data->OUTLETS->OUTLET[0]['instock'],
					'available' => $data['available'] ? 1 : 0,
					'bizoutmax_id' => $data['id'],
					'delivery' => $data->DELIVERY ? 1 : 0
				]
			);
		}
	}
	private function importCategories($data) {
		Category::updateOrCreate(
			['id' => $data['id']],
			[
				'parent_id' => $data['parentid'],
				'name' => $data
			]
		);
	}
	
}