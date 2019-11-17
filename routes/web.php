<?php




Route::group(['middleware' => ['web', 'sleep']], function () {



Route::get('badbrowser', ['uses' => 'HomeController@badbrowser', 'as' => 'badbrowser']);


Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home']);
Route::get('search/{query}', ['uses' => 'SearchController@index', 'as' => 'search']);
Route::get('search', ['uses' => 'SearchController@show', 'as' => 'search.ajax']);

Route::group(['prefix' => 'catalog'], function () {
	Route::get('product/{product_id}', ['uses' => 'Catalog\ProductController@show', 'as' => 'catalog.product']);
	Route::get('{collection_id}', ['uses' => 'Catalog\CollectionController@show', 'as' => 'catalog']);
});

Route::group(['prefix' => 'legal'], function () {
	Route::get('refund', ['uses' => 'Legal\RefundController@show', 'as' => 'legal.refund']);
});



});