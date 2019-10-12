<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
	public function show($id)
	{
		$this->search_query = $request->input('query');
		$this->forwhom = $request->input('forwhom');

		$matches = Product::where('article', $this->search_query)->with('pictures')->with('sizes')->get()->toArray();

		$matches += Product::where(function ($query) {
			$query
				->where('title', 'like', '%'.$this->search_query.'%')
				->orWhere('model', 'like', '%'.$this->search_query.'%')
				->orWhere('vendor', 'like', '%'.$this->search_query.'%');
		})->whereHas('parameters', function ($query) {
				$query->where('value', '=', $this->forwhom);
		})
			->with('pictures')
			->with('sizes')
			->get()
			->toArray();
		

		return $matches;
	}
}
