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
    Route::get('/about', 'KarapuzyController@about')->name('krpz-about');
    Route::post('/add', 'KarapuzyController@add')->name('krpz-add');

});



// Админка
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {

    Route::get('/', 'AdminController@index')->name('admin-index');
    Route::get('/karapuzy', 'KarapuzyController@admin')->name('admin-krpz');


});
