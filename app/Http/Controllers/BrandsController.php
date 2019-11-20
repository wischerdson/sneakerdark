<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrandsController extends SiteController
{
    public function index() {
    	$this->template = 'brands';
		$this->title = 'Бренды - Sneakerdark';
		return $this->output();
    }
}
