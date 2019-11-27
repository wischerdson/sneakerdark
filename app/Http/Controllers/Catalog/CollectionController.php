<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Category;
use App\Product;

class CollectionController extends \App\Http\Controllers\SiteController
{
	private $categories = [];

	public function show(Request $request, $parentCategoryId) {
		$this->template = 'catalog.collection';
		$this->title = 'Коллекция - Sneakerdark';

		$this->vars['currentCategory'] = $parentCategoryId;

		$this->fetchChildCategories($parentCategoryId);
		$Product = Product::where('category_id', $parentCategoryId);
		foreach (array_slice($this->categories, 1) as $categoryId) {
			$Product = $Product->orWhere('category_id', $categoryId);
		}
		$products = $Product->orderBy('created_at', 'desc')->with('pictures')->paginate(8 * 4);
		$this->vars['products'] = $products;


		$categoriesChain = [];
		while ($parentCategoryId) {
			$category = Category::find($parentCategoryId);
			array_push($categoriesChain, $category);
			$parentCategoryId = $category->parent_id;
		}
		$categoriesChain = array_reverse($categoriesChain);
		$this->vars['categoriesChain'] = $categoriesChain;


		return $this->output();
	}

	private function fetchChildCategories($categoryId) {
		$childCategories = Category::where('parent_id', $categoryId)->get();
		array_push($this->categories, $categoryId);
		foreach ($childCategories as $childCategory) {
			$this->fetchChildCategories($childCategory->id);
		}
		return;
	}
}
