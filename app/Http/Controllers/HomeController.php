<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Collection;

class HomeController extends Controller
{
	public function index() {
		$this->template = 'home';
		$this->transparentHeader = true;

		$collectionsIds = Collection::where('supplier_id', 1789)->first()->children;

		$this->vars['newProducts'] = Product::
			whereIn('collection_id', $collectionsIds)->
			with(['sizes', 'description'])->
			orderBy('created_at', 'desc')->
			limit(8)->
			get();

		return $this->output();
	}

	public function badbrowser() {
		return view('templates.badbrowser');
	}

	public function test()
	{
		$this->template = 'test';
		return $this->output();
	}
}