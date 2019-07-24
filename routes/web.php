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

Route::get('/', 'IndexController@index')->name('index');

// Фотоконкурс "Карапузы"
Route::group(['prefix' => 'karapuzy'], function () {

    Route::get('/', 'KarapuzyController@karapuzy')->name('krpz');
    Route::get('/participate', 'KarapuzyController@participate')->name('krpz-participate');
    Route::get('/all', 'KarapuzyController@all')->name('krpz-all');
    Route::get('/about', 'KarapuzyController@about')->name('krpz-about');
    Route::post('/add', 'KarapuzyController@add')->name('krpz-add');
    Route::get('/user-info', 'KarapuzyController@userInfo')->name('krpz-user-info');

});



// Админка
Route::group(['prefix' => 'admin','namespace' => 'Admin', 'middleware' => ['auth']], function () {

    Route::get('/', 'AdminController@index')->name('admin-index');

    Route::get('/karapuzy', 'KrpzController@index')->name('admin-krpz');
    Route::get('/karapuzy/search', 'KrpzController@search')->name('admin-krpz-search');
    Route::get('/karapuzy/edit/{id}', 'KrpzController@edit')->name('admin-krpz-edit');
    Route::get('/karapuzy/update/{id}', 'KrpzController@update')->name('admin-krpz-update');
    Route::get('/karapuzy/destroy/{id}', 'KrpzController@destroy')->name('admin-krpz-destroy');

});
