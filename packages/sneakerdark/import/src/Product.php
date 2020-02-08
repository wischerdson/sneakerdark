<?php

namespace Sneakerdark\Import;

use Cviebrock\EloquentSluggable\Services\SlugService;

use App\Product as ProductModel;
use App\Collection;

class Product
{
	public function __construct($productsInfo, $xml) {
		$productsIds = ProductModel::withoutGlobalScope('instock')->select('sku')->pluck('sku')->toArray();
		$newlyAddedProductsIds = [];
		$collections = (array) Collection::select(['id', 'supplier_id'])->pluck('id', 'supplier_id')->toArray();

		ProductModel::whereNotIn('sku', array_keys($productsInfo))->update(['deleted_at' => time()]);

		$xml->parseOffer([
			'sku1' => 'offer:group_id',
			'sku2' => 'offer:id',
			'price' => 'offer.price',
			'collection_id' => 'offer.categoryId',
			'supplier_url' => 'offer.url',
			'shipping' => 'offer.delivery',
			'instock' => 'offer.outlets.outlet:instock',
			'attribute_name' => 'offer.param:name',
			'attribute_value' => 'offer.param',
			'name' => 'offer.name',
			'vendor' => 'offer.vendor',
			'model' => 'offer.model',
			'description' => 'offer.description',
			'images' => 'offer.picture'
		], function ($data) use (&$productsIds, &$productsInfo, $collections, &$newlyAddedProductsIds) {
			$data['sku'] = $data['sku1'] ?? $data['sku2'];

			if (in_array($data['sku'], $newlyAddedProductsIds)) {

				return;
			}

			if (in_array($data['sku'], $productsIds)) {
				$product = ProductModel::where('sku', $data['sku'])->first();
				$product->price = $product->price < $data['price'] ? $data['price'] : $product->price;
				$product->base_price = $data['price'];
				$product->instock = $productsInfo[$data['sku']]['instock'];
				$product->deleted_at = null;
				$product->save();
				unset($product);
				return;
			}

			$product = new ProductModel;
			$product->sku = $data['sku'];
			$product->base_price = $data['price'];
			$product->price = $data['price'];
			$product->collection_id = $collections[$data['collection_id']];
			$product->supplier_url = $data['supplier_url'];
			$product->shipping = $data['shipping'] == 'true' ? 1 : 0;
			$product->instock = $productsInfo[$data['sku']]['instock'];
			$product->alias = SlugService::createSlug(ProductModel::class, 'alias', $data['name']);
			$product->save();
			$productId = $product->id;
			unset($product);

			ProductDescription::create($data, $productId);
			ProductImage::create($data, $productId);

			$newlyAddedProductsIds[] = $data['sku'];

			/*

			

			$productAttributes = [];
			foreach ((array) $data['attribute_name'] as $key => $value) {
				if (preg_match('/(р|Р)азмер/i', $value)) {
					$productOption = new ProductOption;
					$productOption->product_id = $productCurrentID;
					$productOption->name = $value;
					$productOption->save();
					unset($productOption);
				} else {
					$productAttribute = [];
					$productAttribute['product_id'] = $productCurrentID;
					$productAttribute['attribute_id'] = $attributes[$value];
					$productAttribute['text'] = ((array) $data['attribute_value'])[$key];

					$productAttributes[] = $productAttribute;
				}
			}
			ProductAttribute::insert($productAttributes);*/
		});
	}
}