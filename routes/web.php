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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

Route::get('/', 'LandingController@index')->name('landing');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['prefix' => 'dashboard'], function () {
	
	Route::get('/', 'DashboardController@index')->name('dashboard');

	// ALL PERSONNEL ROUTES
	Route::group(['prefix' => 'personnel'], function () {
		Route::get('/new', 'PersonnelController@new')->name('records_new');
		Route::post('/new/store', 'PersonnelController@store')->name('records_store_new');
		Route::get('/all', 'PersonnelController@all')->name('records_all');
		Route::get('/statistics', 'PersonnelController@statistics')->name('records_statistics');
	});

	// ALL CORSES ROUTES
	Route::group(['prefix' => 'courses'], function () {
		Route::get('/new', 'CourseController@new')->name('records_new');
		Route::post('/new/store', 'CourseController@store')->name('records_store_new');
		Route::get('/all', 'CourseController@all')->name('records_all');
		Route::get('/statistics', 'CourseController@statistics')->name('records_statistics');
	});
	
});
