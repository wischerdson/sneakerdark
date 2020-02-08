<?php

namespace Sneakerdark\Import;

use Cviebrock\EloquentSluggable\Services\SlugService;

use App\Collection as CollectionModel;
use App\CollectionDescription;

class Collection {
	public function __construct($collectionsInfo, $xml) {
		$collectionsIds = CollectionModel::select('supplier_id')->pluck('supplier_id')->toArray();

		$xml->parseCategory([
			'supplier_id' => 'category:id',
			'parent_id' => 'category:parentId',
			'name' => 'category'
		], function ($data) use ($collectionsIds) {
			if (in_array($data['supplier_id'], $collectionsIds)) {
				return;
			}

			$collection = new CollectionModel;
			$collection->supplier_id = $data['supplier_id'];
			$collection->parent_id = $data['parent_id'];
			$collection->alias = SlugService::createSlug(CollectionModel::class, 'alias', $data['name']);
			$collection->save();
			
			$collectionDescription = new CollectionDescription;
			$collectionDescription->collection_id = $collection->id;
			$collectionDescription->name = $data['name'];
			$collectionDescription->meta_title = $data['name'];
			$collectionDescription->save();
		});
	}
}