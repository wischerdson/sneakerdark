<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use XmlParser;

class HomeController extends SiteController
{
	public function index() {
		$this->template = 'home';
		$this->transparentHeader = true;

		return $this->output();
	}

	public function badbrowser() {
		return view('templates.badbrowser');
	}

	
	public function test() {
		return;
	}
}
