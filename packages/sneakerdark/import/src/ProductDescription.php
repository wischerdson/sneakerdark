<?php

namespace Sneakerdark\Import;

use App\ProductDescription as ProductDescriptionModel;

class ProductDescription {
	public static function create($data, $productId) {
		$data['meta_title'] = $data['name'].' купить по цене {{ $price }} в интернет-магазине sneakerdark.ru с доставкой';

		$data['meta_description'] = $data['name'].' купить в интернет-магазине sneakerdark.ru по выгодной цене {{ $price }}. Большой выбор товаров по низким ценам! Акции и скидки на сайте. Есть доставка. Звоните 8-800-505-42-51.';

		$data['description'] = preg_replace('/&lt;/', '<', $data['description']);
		$data['description'] = preg_replace('/&gt;/', '>', $data['description']);
		$data['description'] = preg_replace('/&amp;/', '&', $data['description']);
		$data['description'] = preg_replace('/ style=".*?"/', '', $data['description']);

		$productDescription = new ProductDescriptionModel;
		$productDescription->product_id = $productId;
		$productDescription->name = $data['name'];
		$productDescription->description = $data['description'];
		$productDescription->model = $data['model'];
		$productDescription->vendor = $data['vendor'];
		$productDescription->meta_title = $data['meta_title'];
		$productDescription->meta_description = $data['meta_description'];
		$productDescription->save();
		unset($productDescription);
	}
}