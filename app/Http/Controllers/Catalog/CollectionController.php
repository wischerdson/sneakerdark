<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CollectionController extends \App\Http\Controllers\SiteController
{
    public function show(Request $request, $collection_id) {
    	$this->template = 'catalog.collection';
    	$this->title = 'Коллекция - Sneakerdark';
    	return $this->output();
    }
}
