<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Collection;
use App\Product;

class CollectionController extends \App\Http\Controllers\SiteController
{
	private $collections = [];

	public function show(Request $request, $parentCollectionId) {
		/*$this->template = 'catalog.collection';
		$this->title = 'Коллекция - Sneakerdark';

		$this->vars['currentCollection'] = $parentCollectionId;

		$this->fetchChildCategories($parentCollectionId);
		$Product = Product::where('collection_id', $parentCollectionId);
		foreach (array_slice($this->collections, 1) as $collectionId) {
			$Product = $Product->orWhere('collection_id', $collectionId);
		}
		$products = $Product->orderBy('created_at', 'desc')->with('pictures')->paginate(8 * 4);
		$this->vars['products'] = $products;*/


		$collection = Collection::find($parentCollectionId);

		dd($collection->children);
		
		return;

		/*$collectionsChain = [];
		while ($parentCollectionId) {
			$collection = Collection::find($parentCollectionId);
			array_push($collectionsChain, $collection);
			$parentCollectionId = $collection->parent_id;
		}

		$collectionsChain = array_reverse($collectionsChain);*/
		//dd(Collection::find($parentCollectionId)->chain);
		$this->vars['collectionsChain'] = Collection::find($parentCollectionId)->chain;



		return $this->output();
	}

	private function fetchChildCategories($collectionId) {
		$childCategories = Collection::where('parent_id', $collectionId)->get();
		array_push($this->collections, $collectionId);
		foreach ($childCategories as $childCollection) {
			$this->fetchChildCategories($childCollection->id);
		}
		return;
	}
}
