<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Category;
use App\Product;

class CollectionController extends \App\Http\Controllers\SiteController
{
    public function show(Request $request, $collection_id) {
    	$this->template = 'catalog.collection';
    	$this->title = 'Коллекция - Sneakerdark';





  //   	$this->vars['products'] = Category::where('id', $collection_id)->with('products')->get();

    	$categoriesChain = [];
    	$categoriesIds = [$collection_id];
		$categoryParentId = $collection_id;
		while ($categoryParentId) {
			$category = Category::where('parent_id', $categoryParentId);
			array_push($categoriesChain, $category);
			array_push($categoriesIds, $category->id);
			$categoryParentId = $category->parent_id;
		}
		$categoriesChain = array_reverse($categoriesChain);

		dd($categoriesIds);
		dd(Product::whereIn('id', [126, 139])->get());

    	
    	//dd($this->vars['products']);
    	return $this->output();
    }
}
