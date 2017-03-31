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


Route::get('/', 				['as' => 'pages.home',  			'uses' => 'HomeController@index']);
Route::get('/about', 			['as' => 'pages.about',  			'uses' => 'HomeController@about']);
Route::get('/privacy_policy', 	['as' => 'pages.privacy_policy',  	'uses' => 'HomeController@privacy_policy']);
Route::get('/sitemap.xml', 	    ['as' => 'pages.sitemap',  	        'uses' => 'HomeController@sitemap']);


/**
 *  Ajax
 */
Route::get('/search/{type}/{param}', 	['uses' => 'HomeController@search']);
Route::get('/components/category/{id}', ['uses' => 'ComponentController@category']);

Route::resource('boards',               'BoardController');
Route::resource('components',           'ComponentController');
Route::resource('component_categories', 'ComponentCategoriesController',    ['only' => ['create', 'store', 'edit', 'update']]);
Route::resource('manufacturers',        'ManufacturerController',           ['except' => ['index']]);
Route::resource('mcus',                 'McuController',                    ['except' => ['index']]);

/**
 *  References
 */
Route::get('/sketches/{sketches}/star',        ['as' => 'sketches.star',          'uses' => 'ReferenceController@star']);
Route::get('/sketches/{sketches}/unstar',      ['as' => 'sketches.unstar',        'uses' => 'ReferenceController@unstar']);
Route::get('/sketches/{sketches}/file/{file}', ['as' => 'sketches.file',          'uses' => 'ReferenceController@file']);
Route::get('/sketches/{sketches}/files',       ['as' => 'sketches.files',         'uses' => 'ReferenceController@files']);
Route::get('/sketches/{sketches}/show',        ['as' => 'sketches.show',          'uses' => 'ReferenceController@show']);
Route::get('/sketches/{sketches}/publish',     ['as' => 'sketches.publish',       'uses' => 'ReferenceController@publish']);
Route::post('/sketches/preview',               ['as' => 'sketches.preview',       'uses' => 'ReferenceController@preview']);
Route::get('/sketches/data/boards',            ['as' => 'sketches.data.boards',   'uses' => 'ReferenceController@boards']);
Route::get('/sketches/data/mcus',              ['as' => 'sketches.data.mcus',     'uses' => 'ReferenceController@mcus']);
Route::resource('sketches',                    'ReferenceController',   ['except' => ['show']]);


/**
 *  Auth
 */
Route::get('/auth',                 ['as' => 'auth.index',  'uses' => 'Auth\SocialiteAuthController@index']);
Route::get('/auth/login/{driver}',  ['as' => 'auth.login',  'uses' => 'Auth\SocialiteAuthController@login']);
Route::get('/auth/logout',          ['as' => 'auth.logout', 'uses' => 'Auth\SocialiteAuthController@logout']);



/**
 *  Profile
 */
Route::get('/profiles/show/{id?}',          ['as' => 'profiles.index',       'uses' => 'ProfileController@show']);
Route::get('/profiles/sketches/{id?}',    	['as' => 'profiles.sketches',    'uses' => 'ProfileController@references']);
Route::get('/profiles/edit',                ['as' => 'profiles.edit',        'uses' => 'ProfileController@edit']);
Route::patch('/profiles',                   ['as' => 'profiles.update',      'uses' => 'ProfileController@update']);
Route::get('/profiles/starred',             ['as' => 'profiles.starred',     'uses' => 'ProfileController@starred']);
