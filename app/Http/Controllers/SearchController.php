<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class SearchController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request)
	{
		$searchQuery = $request->input('query');
		$gender = $request->input('gender');

		if (!$searchQuery) return;

		$matches = Product::where('article', $searchQuery)->with('pictures')->with('sizes')->get()->toArray();

		$matches += Product::where(function ($query) use ($searchQuery) {
			$query
				->where('title', 'like', '%'.$searchQuery.'%')
				->orWhere('model', 'like', '%'.$searchQuery.'%')
				->orWhere('vendor', 'like', '%'.$searchQuery.'%');
		})->whereHas('parameters', function ($query) use ($gender) {
				$query->where('value', '=', $gender);
		})
			->with('pictures')
			->with('sizes')
			->get()
			->toArray();

		$resultsNumber = count($matches);
		$subject = smart_ending(count($matches), ['', 'а', 'ов'], 'результат');

		$matches = $matches > 10 ? array_slice($matches, 0, 10) : $matches;

		foreach ($matches as $key => $value) {
			$matches[$key]['url'] = route('shop.product', ['product_id' => $value['article']]);
		}

		return [
			'results' => $matches,
			'results_number' => $resultsNumber,
			'subject' => $subject
		];
	}
}
