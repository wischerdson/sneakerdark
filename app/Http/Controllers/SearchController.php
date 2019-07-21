<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Bizoutmax;

class SearchController extends Controller
{
	public function index(Request $request, $query = null) {
		/*if ($request->isMethod('post'))
			return $this->process_ajax_query($request->input('query'));*/
		return $request;
	}

	public function process_ajax_query(Request $request) {

		$bizoutmax = new Bizoutmax();

		return (array) $bizoutmax->get_by_group_id(10578);
		return (array) $bizoutmax->get_products()[0]['group_id'];
		return $bizoutmax->get_attr_params($bizoutmax->get_products()[0]);
		return (array) $bizoutmax->whereParameter('Пол', 'Женский', $bizoutmax->get_products());


		// return $request->input();
		// $product = Bizoutmax::get_yml_products()[0];
		// return Bizoutmax::get_attr_params($product);
		//return param[0]['name'];
	}
}
