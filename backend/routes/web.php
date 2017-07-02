<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['middleware' => ['guest']], function () {

Route::get('/', 'Inherit\InheritController@index');
Route::post('/add', 'Inherit\InheritController@add');
Route::post('/delete', 'Inherit\InheritController@delete');
Route::get('/run', 'Inherit\InheritServiceController@run');

Route::get('/test', 'Inherit\InheritController@test');


//Подтверждение
Route::get('/confirm/{wallet}/live', 'Inherit\ConfirmController@index');
Route::post('/confirm/{wallet}/live', 'Inherit\ConfirmController@confirm');
Route::get('/confirm/{wallet}/do', 'Inherit\ConfirmController@confirmed')->name('confirm_do');
Route::get('/confirm/{wallet}/error', 'Inherit\ConfirmController@error')->name('confirm_error');
Route::get('/confirm/{wallet}/bad', 'Inherit\ConfirmController@bad')->name('confirm_bad');
Route::get('/confirm/{wallet}/toolate', 'Inherit\ConfirmController@toolate')->name('confirm_toolate');


});


Auth::routes();                                              


