<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\SearchResourceCollection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Product;

class SearchController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request): SearchResourceCollection
	{
		$q = $request->input('q');
		$gender = $request->input('gender') ?? 'all';
		
		if (!$q)
			abort(404, 'One of the parameters specified was missing or invalid: q is incorrect');

		$findedBySku = Product::where('sku', $q)->get();

		$findedByQ = Product::where(function ($query) use ($q, $gender) {
			$query->
			whereHas('description', function ($productDescriptionQuery) use ($q) {
				$productDescriptionQuery->
				where('name', 'like', '%'.$q.'%')->
				orWhere('model', 'like', '%'.$q.'%')->
				orWhere('vendor', 'like', '%'.$q.'%');
			})->
			orWhereHas('attributes', function ($productAttributeQuery) use ($q, $gender) {
				$productAttributeQuery->where('text', 'like', '%'.$q.'%');
			});
		})->when($gender != 'all', function ($query1) use ($gender) {
			$query1->whereHas('attributes', function ($productAttributeQuery) use ($gender) {
				$productAttributeQuery->where('text', $gender);
			});
		})->orderBy('created_at', 'DESC')->get();

		$results = $findedBySku->merge($findedByQ);

		return new SearchResourceCollection($results);
	}
}
