<?php

namespace Sneakerdark\Import;

use App\ProductImage as ProductImageModel;

class ProductImage {
	public static function create($data, $productId) {
		$productImages = [];
		foreach ((array) $data['images'] as $image) {
			$productImage = [];
			$productImage['supplier_src'] = $image;
			$productImage['product_id'] = $productId;
			$productImage['created_at'] = time();
			$productImage['updated_at'] = time();

			$productImages[] = $productImage;
		}
		ProductImageModel::insert($productImages);
		unset($productImages);
	}
}