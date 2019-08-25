<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home']);
Route::get('/search/{query}', ['uses' => 'SearchController@index', 'as' => 'search']);
Route::get('/auth', ['uses' => 'AuthController@authentication', 'as' => 'auth.authentication']);
Route::get('/registration', ['uses' => 'AuthController@registration', 'as' => 'auth.registration']);






Route::group(['prefix' => 'account', 'middleware' => ['web', 'customer_authenticated']], function () {
	Route::get('/register', ['as' => 'account.register', 'uses' => 'AuthController@showRegisterForm']);
	Route::get('/login/vk', ['as' => 'account.login.vk', 'uses' => 'AuthController@loginVk']);
	Route::get('/login/vk/access_token', ['as' => 'account.login.vk.access_token', 'uses' => 'AuthController@vkAccessToken']);
	Route::post('/create', ['as' => 'account.create', 'uses' => 'AuthController@register']);
});



Route::group(['prefix' => 'account', 'middleware' => ['web', 'customer']], function () {
	Route::get('/', ['as' => 'account', 'uses' => 'AccountController@index']);
	Route::get('/logout', ['as' => 'account.logout', 'uses' => 'AuthController@logout']);
});




Route::post('/search', ['uses' => 'SearchController@process_ajax_query', 'as' => 'search.process_ajax_query']);