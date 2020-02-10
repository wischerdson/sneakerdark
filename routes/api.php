<?php

use Illuminate\Http\Request;

Route::apiResource('/catalog', 'API\Catalog\CollectionController', ['as' => 'api']);
Route::apiResource('/cart', 'API\CartController', ['as' => 'api']);
Route::apiResource('/search', 'API\SearchController', ['as' => 'api'])->only(['index']);
Route::apiResource('/token', 'API\SearchController', ['as' => 'api'])->only(['store']);