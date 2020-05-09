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
Route::get('/login', 'LandingController@index')->name('login_page');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['prefix' => 'dashboard'], function () {
	
	// Route::get('/', 'DashboardController@index')->name('dashboard');

	// ALL PERSONNEL ROUTES
	Route::group(['prefix' => 'personnel'], function () {
		Route::get('/', 'PersonnelController@index');

		Route::get('/contract', 'PersonnelController@contract')->name('personnel_contract');
		Route::get('/get_all_contract', 'PersonnelController@get_all_contract')->name('personnel_get_contract');

		Route::get('/military', 'PersonnelController@military')->name('personnel_military');
		Route::get('/get_all_military', 'PersonnelController@get_all_military')->name('personnel_get_military');

		Route::get('/senior', 'PersonnelController@senior')->name('personnel_senior');
		Route::get('/get_all_senior', 'PersonnelController@get_all_senior')->name('personnel_get_senior');

		Route::get('/junior', 'PersonnelController@junior')->name('personnel_junior');
		Route::get('/get_all_junior', 'PersonnelController@get_all_junior')->name('personnel_get_junior');

		Route::get('/all', 'PersonnelController@index')->name('personnel_all');
		Route::get('/get_all', 'PersonnelController@get_all')->name('personnel_get_all');

		Route::get('/archived', 'PersonnelController@archive')->name('personnel_archive');
		Route::get('/get_all_archive', 'PersonnelController@get_all_archive')->name('personnel_get_archive');

		Route::get('/{user}/profile', 'PersonnelController@show')->name('personnel_profile');
		Route::get('/new', 'PersonnelController@create')->name('personnel_new');
		Route::post('/new/store', 'PersonnelController@store')->name('personnel_store_new');
		Route::get('/{user}/edit', 'PersonnelController@edit')->name('personnel_edit');
		Route::put('/{user}/update', 'PersonnelController@update')->name('personnel_update');
		Route::delete('/{user}/delete', 'PersonnelController@destroy')->name('personnel_delete');
		Route::post('/{user}/document/upload', 'PersonnelController@upload_document')->name('personnel_doc_upload');

		Route::put('/assign/{user}/course', 'PersonnelController@assign')->name('personnel_assign_course');
		Route::get('/detach/{user}/{course}', 'PersonnelController@detach')->name('personnel_detach_course');
		
		Route::put('/progression/{user}/add', 'PersonnelController@add_progression')->name('personnel_add_progression');
		Route::get('/progression/{user}/remove/{progression}', 'PersonnelController@remove_progression')->name('personnel_remove_progression');
		
		Route::put('/posting/{user}/add', 'PersonnelController@add_posting')->name('personnel_add_posting');
		Route::get('/posting/{user}/remove/{posting}', 'PersonnelController@remove_posting')->name('personnel_remove_posting');
	});

	Route::group(['prefix' => 'file'], function () {
		Route::delete('/document/{document}/delete', 'PersonnelController@destroyDocument')->name('deletePersonnelDocument');
	});

	// ALL CORSES ROUTES
	Route::group(['prefix' => 'courses'], function () {
		Route::get('/', 'CourseController@index');

		Route::get('/all', 'CourseController@index')->name('courses_all');
		Route::get('/get_all', 'CourseController@get_all')->name('courses_get_all');
		Route::get('/search', 'CourseController@search')->name('courses_search');
		Route::get('/new', 'CourseController@create')->name('courses_new');
		Route::post('/courses_search', 'CourseController@courses_search')->name('courses_search');
		Route::post('/new/store', 'CourseController@store')->name('courses_store_new');
		Route::get('/{course}/delete', 'CourseController@destroy')->name('courses_delete');
	});
	
});
