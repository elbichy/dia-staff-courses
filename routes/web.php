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

	// ALL PATIENTS ROUTES
	Route::group(['prefix' => 'patient'], function () {
		Route::get('/new', 'RecordController@new')->name('records_new');
		Route::post('/new/store', 'RecordController@store')->name('records_store_new');

		// REG PAYMENT ROUTES
		Route::group(['prefix' => 'pending-payment'], function () {
            Route::get('/', 'AccountController@pending_payment')->name('pending_payment');
            Route::get('/{id}/process', 'AccountController@show')->name('show_reg_payment');
            Route::patch('/process/{id}/confirm', 'AccountController@confirmRegPayment')->name('confirm_reg_payment');
		});
		
		Route::get('/all', 'RecordController@all')->name('records_all');
		Route::get('/statistics', 'RecordController@statistics')->name('records_statistics');
	});
	
	Route::group(['prefix' => 'treatment'], function () {
		Route::get('/initiate', 'RecordController@initate_treatment')->name('treatment_initate');
		Route::get('/active', 'RecordController@active_treatments')->name('treatments_active');
		Route::get('/completed', 'RecordController@completed_treatments')->name('treatments_completed');

		// Account treatment ROUTES
		Route::group(['prefix' => 'account'], function () {
            Route::get('/successful', 'AccountController@successful')->name('account_successful');
            Route::get('/cancelled', 'AccountController@cancelled')->name('account_cancelled');
            // Route::get('/capture/{id}', 'AccountController@capture')->name('nurse_capture');
            // Route::post('/capture/{treatment}', 'AccountController@store')->name('nurse_capture_store');
		});

		// NURSE treatment ROUTES
		Route::group(['prefix' => 'nurse'], function () {
            Route::get('/', 'NurseController@index')->name('nurse_all');
			Route::get('/capture/{id}', 'NurseController@capture')->name('nurse_capture');
			Route::get('/successful', 'NurseController@successful')->name('nurse_successful');
            Route::get('/cancelled', 'NurseController@cancelled')->name('nurse_cancelled');
            Route::post('/capture/{treatment}', 'NurseController@store')->name('nurse_capture_store');
		});

		// DOCTORS diagnoses ROUTES
		Route::group(['prefix' => 'doctor'], function () {
            Route::get('/', 'DoctorController@index')->name('doctor_all');
			Route::get('/diagnose/{id}', 'DoctorController@diagnose')->name('doctor_diagnoses');
			Route::get('/successful', 'DoctorController@successful')->name('doctor_successful');
            Route::get('/cancelled', 'DoctorController@cancelled')->name('doctor_cancelled');
            Route::post('/diagnose/{treatment}', 'DoctorController@store')->name('doctor_diagnoses_store');
		});
	});

});
