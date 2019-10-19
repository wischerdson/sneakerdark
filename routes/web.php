<?php

Route::get('badbrowser', ['uses' => 'HomeController@badbrowser', 'as' => 'badbrowser']);


Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home']);
Route::get('search/{query}', ['uses' => 'SearchController@index', 'as' => 'search']);
Route::get('search', ['uses' => 'SearchController@show', 'as' => 'search.ajax']);

Route::group(['prefix' => 'shop'], function () {
	Route::get('product/{product_id}', ['uses' => 'Shop\ProductController@show', 'as' => 'shop.product']);
	Route::get('collection', ['uses' => 'Shop\CollectionController@show', 'as' => 'shop.collection']);
});