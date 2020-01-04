<?php

use Illuminate\Http\Request;

Route::apiResource('/catalog', 'API\Catalog\CollectionController', ['as' => 'api']);
Route::apiResource('/cart', 'API\CartController', ['as' => 'api']);