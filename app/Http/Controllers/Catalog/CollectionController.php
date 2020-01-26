<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Collection;
use App\Product;

class CollectionController extends Controller
{
	private $collections = [];

	public function show(Request $request, $collectionId) {
		$this->template = 'catalog.collection';
		$this->title = 'Коллекция - Sneakerdark';
		$collection = Collection::find($collectionId);
		$this->vars['collection'] = $collection;
		$this->vars['collectionsChain'] = $collection->chain;

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
