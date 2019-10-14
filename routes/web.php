<?php

Route::get('/', ['uses' => 'HomeController@index', 'as' => 'home']);
Route::get('/search/{query}', ['uses' => 'SearchController@index', 'as' => 'search']);
Route::get('/search', ['uses' => 'SearchController@show', 'as' => 'search.ajax']);