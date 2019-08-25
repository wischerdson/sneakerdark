<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Bizoutmax;

use App\Product;

class SearchController extends Controller
{
	private $forwhom;
	private $search_query;

	public function index(Request $request, $query = null) {
		/*if ($request->isMethod('post'))
		return $this->process_ajax_query($request->input('query'));*/
		return $request;
	}

	public function process_ajax_query(Request $request) {
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
