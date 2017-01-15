<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

// This is where the user can see a login button for logging into Google
Route::get('/', 'HomeController@index');

// This is where the user gets redirected upon clicking the login button on the home page
Route::get('/login', 'HomeController@login');

// Shows a list of things that the user can do in the app
Route::get('/dashboard', 'AdminController@index');

// Shows a list of files in the users' Google drive
Route::get('/files', 'AdminController@files');

// Allows the user to search for a file in the Google drive
Route::get('/search', 'AdminController@search');

// Allows the user to upload new files
Route::get('/upload', 'AdminController@upload');
Route::post('/upload', 'AdminController@doUpload');

// Allows the user to delete a file
Route::get('/delete/{id}', 'AdminController@delete');

Route::get('/downloadFile/{id}', 'AdminController@downloadFile');

//Route::get('/proxyThumb', 'AdminController@proxyThumb');

Route::get('/logout', 'AdminController@logout');

/////


Route::group(['middleware' => 'web'], function () {
    Route::get('/tokens',['as' => 'tokens.index', 'uses' => 'TokenController@index']);
	Route::get('/tokens/create',['as' => 'tokens.create', 'uses' => 'TokenController@create']);
	Route::get('/tokens/show/{id}',['as' => 'tokens.show', 'uses' => 'TokenController@show']);
	Route::get('/tokens/edit/{id}',['as' => 'tokens.edit', 'uses' => 'TokenController@edit']);
	//
	Route::post('/tokens/store',['as' => 'tokens.store', 'uses' => 'TokenController@store']);

	Route::delete('/tokens/destroy/{id}',['as' => 'tokens.destroy', 'uses' => 'TokenController@destroy']);

	Route::put('/tokens/update/{id}',['as' => 'tokens.update', 'uses' => 'TokenController@update']);
});



