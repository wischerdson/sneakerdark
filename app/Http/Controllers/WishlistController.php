<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends SiteController
{
    public function index() {
    	$this->template = 'wishlist';
		$this->title = 'Избранное - Sneakerdark';

		return $this->output();
    }
}
