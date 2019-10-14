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

Auth::routes();

// Landing page shows a submit form
Route::get('/', 'InfoController@index')->name('landing');

// Validates and stores the list info
Route::post('/enlist', 'InfoController@enlistInfo')->name('enlist');

// Shows list of submitted info to authenticated users.
Route::get('/info-list', 'InfoController@showList')->name('info-list')->middleware('auth');
