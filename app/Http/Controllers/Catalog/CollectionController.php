<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Collection;
use App\Product;

class CollectionController extends Controller
{
	private $collections = [];

	public function show(Request $request, $collection_alias) {
		$this->template = 'catalog.collection';
		$this->title = 'Коллекция - Sneakerdark';
		$collection = Collection::findByAlias($collection_alias) ?? abort(404);
		$this->vars['collection'] = $collection;
		$this->vars['collectionsChain'] = $collection->chain;

		return $this->output();
	}
}
