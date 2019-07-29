<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Bizoutmax;

use App\Product;

class SearchController extends Controller
{
	public function index(Request $request, $query = null) {
		/*if ($request->isMethod('post'))
		return $this->process_ajax_query($request->input('query'));*/
		return $request;
	}

	public function process_ajax_query(Request $request) {

		$search_query = $request->input('query');
		$forwhom = $request->input('forwhom');

		if (preg_match('/^[0-9]+$/', $search_query)) {
			$matches = Product::where('article', 'like', '%'.$search_query.'%')->get();

			return $matches;
		}


		$matches = Product::where('title', 'like', '%'.$search_query.'%')
			->orWhere('model', 'like', '%'.$search_query.'%')
			->orWhere('vendor', 'like', '%'.$search_query.'%')
			->get();

		return $request;
		/*$query = $request->input('query');
		$forwhom = $request->input('forwhom');

		$bizoutmax = new Bizoutmax();

		$products = $bizoutmax->get_products();
		$products = $bizoutmax->whereParameter('Пол', $forwhom, $products);

		return config('app.import_link');

		$result = [];
		foreach ($products as $product) {
			if (
				stripos($product->name, $query) !== false or
				stripos($product->model, $query) !== false or
				stripos($product->vendor, $query) !== false or
				stripos($product->group_id, $query) !== false
			) array_push($result, $product);
		}
		return $result;
		return [
			'html' => view('/sections/nav-search-result')->with([
				'products' => $result
			]),
			'matches' => count($result)
		];*/
	}
}
