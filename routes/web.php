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

/* Client area routes */

Auth::routes();
Route::get('/', 'indexController');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/serial/{id}', 'serialFrontController@index')->name('serial_front');
Route::post('/serial/{id}', 'serialFrontController@setMark');
Route::post('/favorite/{id}', 'FavoritesController@add')->name('favorite');

Route::get('/params', 'paramsController@index')->name('params');
Route::post('/params', 'paramsController@postResult')->name('params_post');

Route::get('/search', 'searchController@index')->name('search');

/* Admin area routes */

Route::group(
    [
        'as'         => 'admin::',
        'middleware' => 'auth',
        'namespace'  => 'Admin',
        'prefix'     => 'admin'
    ], function() {

    Route::get('login', function() {
        return view('admin.login');
    });

    Route::resource('serials', 'SerialController');

    Route::get('import', 'importController@index')->name('import');
});