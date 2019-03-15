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

/* Route::get('/', function () {
    return view('home');
}); */

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/help', 'HomeController@help');
Route::get('/file/manage', 'FilesController@manage');
Route::get('/file/trash', 'FilesController@trash');
Route::get('/file/m2t/{id}', 'FilesController@m2t');
Route::get('/file/m2f/{id}', 'FilesController@m2f');
Route::get('/download', 'FilesController@getDownload');
Route::resource('/file','FilesController');
Route::get('/search','FilesController@imgprev');