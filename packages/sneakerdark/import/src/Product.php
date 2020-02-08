<?php

namespace Sneakerdark\Import;

use Cviebrock\EloquentSluggable\Services\SlugService;

use App\Product as ProductModel;
use App\Attribute;
use App\Collection;

class Product
{
	public function __construct($xml, $productsInfo) {
		$productsIds = ProductModel::select('sku')->pluck('sku')->toArray();
		$newlyAddedProductsIds = [];
		$collections = (array) Collection::select(['id', 'supplier_id'])->pluck('id', 'supplier_id')->toArray();
		$attributes = Attribute::select('name', 'id')->distinct()->pluck('id', 'name')->toArray();
		
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
		], function ($data) use (
			$productsIds,
			$productsInfo,
			$collections,
			&$newlyAddedProductsIds,
			$attributes
		) {
			$data['sku'] = $data['sku1'] ?? $data['sku2'];

			if (in_array($data['sku'], $newlyAddedProductsIds)) {
				return;
			}

			$newlyAddedProductsIds[] = $data['sku'];

			if (in_array($data['sku'], $productsIds)) {
				$product = ProductModel::where('sku', $data['sku'])->first();
				$product->price = $product->price < $data['price'] ? $data['price'] : $product->price;
				$product->base_price = $data['price'];
				$product->instock = $productsInfo[$data['sku']];
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
			$product->instock = $productsInfo[$data['sku']];
			$product->alias = SlugService::createSlug(ProductModel::class, 'alias', $data['name']);
			$product->save();
			$productId = $product->id;
			unset($product);

			ProductDescription::create($data, $productId);
			ProductImage::create($data, $productId);

			$params = array_combine((array) $data['attribute_name'], (array) $data['attribute_value']);
			ProductAttribute::create($params, $productId, $attributes);
		});
	}
}