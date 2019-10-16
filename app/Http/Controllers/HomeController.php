<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends SiteController
{
    public function index() {
    	$this->template = 'home';
    	$this->title = 'Sneakerdark';

    	return $this->output();
    }

    public function badbrowser() {
    	return view('templates.badbrowser');
    }
}
