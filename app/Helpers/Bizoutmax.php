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
	private $articles_importProducts = [];
	private $articles_importParameters = [];
	private $articles_importPictures = [];

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
			foreach ($tables['offer'] as $table) {
				$this->{'import'.ucfirst($table)}($data);
			}
		});

		$xmlParser->start($this->xmlFilePath);
	}
	private function importParameters($data) {
		if (in_array($data->VENDORCODE, $this->articles_importParameters)) return;
		array_push($this->articles_importParameters, $data->VENDORCODE);

		$i = 0;

		foreach ($data->PARAM as $key => $value) {
			if (preg_match('/Размер/', $value['name'], $matches)) continue;

			Parameter::updateOrCreate(
				['id' => $data->VENDORCODE.$i],
				[
					'product_id' => $data->VENDORCODE,
					'key' => $value['name'],
					'value' => $value[0]
				]
			);
			$i++;
		}
	}
	private function importPictures($data) {
		if (in_array($data->VENDORCODE, $this->articles_importPictures)) return;
		array_push($this->articles_importPictures, $data->VENDORCODE);

		$i = 0;

		foreach ($data->PICTURE as $key => $picture) {
			Picture::updateOrCreate(
				['id' => $data->VENDORCODE.$i],
				[
					'product_id' => $data->VENDORCODE,
					'bizoutmax_src' => (string) $picture
				]
			);
			$i++;
		}
	}
	private function importSizes($data) {
		foreach ($data->PARAM as $key => $value) {
			if (!preg_match('/Размер/', $value['name'])) continue;
			Size::updateOrCreate(
				['id' => $data->VENDORCODE.((string) $value)],
				[
					'product_id' => $data->VENDORCODE,
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
	private function importProducts($data) {
		if (in_array($data->VENDORCODE, $this->articles_importProducts)) return;
		array_push($this->articles_importProducts, $data->VENDORCODE);

		$description = $data->DESCRIPTION;

		$description = preg_replace('/&lt;/', '<', $data->DESCRIPTION);
		$description = preg_replace('/&gt;/', '>', $description);
		$description = preg_replace('/&amp;/', '&', $description);
		$description = preg_replace('/ style=".*?"/', '', $description);


		Product::updateOrCreate(
			['id' => $data->VENDORCODE],
			[
				'title' => $data->NAME,
				'price' => $data->PRICE,
				'article' => $data->VENDORCODE,
				'bizoutmax_url' => $data->URL,
				'category_id' => $data->CATEGORYID,
				'model' => $data->MODEL,
				'description' => $description,
				'vendor' => $data->VENDOR
			]
		);
	}
}