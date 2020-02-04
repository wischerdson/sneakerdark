<?php

Route::get('badbrowser', ['uses' => 'HomeController@badbrowser', 'as' => 'badbrowser']);

Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home']);
Route::get('search/{query}', ['uses' => 'SearchController@index', 'as' => 'search']);

Route::group(['prefix' => 'catalog'], function () {
	Route::get('product/{product_alias}', ['uses' => 'Catalog\ProductController@show', 'as' => 'catalog.product']);
	Route::get('{collection_alias}', ['uses' => 'Catalog\CollectionController@show', 'as' => 'catalog']);
});

Route::group(['prefix' => 'legal'], function () {
	Route::get('refund', ['uses' => 'Legal\RefundController@show', 'as' => 'legal.refund']);
});


Route::group(['prefix' => 'brands'], function () {
	Route::get('/', ['uses' => 'BrandsController@index', 'as' => 'brands']);
	Route::get('{brand}', ['uses' => 'BrandsController@show', 'as' => 'brands.brand']);
});

Route::get('/wishlist', ['uses' => 'WishlistController@index', 'as' => 'wishlist']);
Route::get('test', ['uses' => 'HomeController@test']);