<?php
//https://www.sitepoint.com/how-to-build-an-api-only-jwt-powered-laravel-app/
//https://github.com/francescomalatesta/laravel-api-boilerplate-jwt
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {

	$api->group(['middleware' => 'cors'], function ($api) {
		$api->get('mosaic', 'App\Api\V1\Controllers\MosaicController@index');
	});

	$api->post('auth/login', 'App\Api\V1\Controllers\AuthController@login');

	$api->post('auth/signup', 'App\Api\V1\Controllers\AuthController@signup');

	$api->post('auth/recovery', 'App\Api\V1\Controllers\AuthController@recovery');

	$api->post('auth/reset', 'App\Api\V1\Controllers\AuthController@reset');

	/*$api->group(['middleware' => 'api.auth'], function ($api) {
		$api->resource('books', 'App\Api\V1\Controllers\BookController');
    });*/
    $api->group(['middleware' => 'api.auth'], function ($api) {
		$api->get('books', 'App\Api\V1\Controllers\BookController@index');
		$api->get('books/{id}', 'App\Api\V1\Controllers\BookController@show');
		$api->post('books', 'App\Api\V1\Controllers\BookController@store');
		$api->put('books/{id}', 'App\Api\V1\Controllers\BookController@update');
		$api->delete('books/{id}', 'App\Api\V1\Controllers\BookController@destroy');
	});
});