<?php


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/help', 'HomeController@help');
Route::get('/file/swm', 'FilesController@swm');
Route::get('/file/manage', 'FilesController@manage');
Route::get('/file/trash', 'FilesController@trash');
Route::get('/file/m2t/{id}', 'FilesController@m2t');
Route::get('/file/m2f/{id}', 'FilesController@m2f');
Route::get('/file/delbyS/{id}', 'ManageFilesController@delbyS');
Route::get('/file/delbyO/{id}', 'ManageFilesController@delbyO');
Route::get('/file/download/{id}', 'FilesController@getDownload');
Route::get('/file/preview/{id}', 'FilesController@getPrev');
Route::post('/file/share','ManageFilesController@addshare');
Route::resource('/file','FilesController');
