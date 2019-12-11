<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class HomeController extends SiteController
{
	public function index() {
		$this->template = 'home';
		$this->title = 'Sneakerdark';
		$this->transparentHeader = true;

		return $this->output();
	}

	public function badbrowser() {
		return view('templates.badbrowser');
	}
}
