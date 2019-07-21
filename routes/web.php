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
Route::post('/search', ['uses' => 'SearchController@process_ajax_query', 'as' => 'search.process_ajax_query']);