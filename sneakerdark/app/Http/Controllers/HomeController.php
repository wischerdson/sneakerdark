<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Crypt;

class HomeController extends Controller
{
	public function index() {
		return view('home')->with([
			'links' => ['/css/home.css'],
			'scripts' => ['/js/slick.min.js'],
			'title' => 'Sneakerdark',
		]);
	}
}
