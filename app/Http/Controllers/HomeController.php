<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
	public function index() {
		return view('home')->with([
			'links' => ['/css/home.css'],
			'scripts' => ['/js/slick.min.js'],
			'title' => 'Sneakerdark',
			// 'yml' => simplexml_load_file('http://bizoutmax.ru/price/export/4.yml')
		]);
	}
}
