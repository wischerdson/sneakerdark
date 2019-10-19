<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function show(Request $request) {
    	$this->template = 'shop.collection';
    	$this->title = 'Коллекция - Sneakerdark';
    	return $this->output();
    }
}
