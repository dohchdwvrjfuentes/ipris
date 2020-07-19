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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/getAreaData', 'HomeController@getAreaData')->name('getAreaData');
Route::get('/getMunicipality', 'HomeController@getMunicipality')->name('getMunicipality');
Route::get('/getBarangay', 'HomeController@getBarangay')->name('getBarangay');


Route::group(['middleware' => 'auth'], function () {
    Route::resource('person', 'PersonController');

    Route::get('/getFilter', 'PersonController@filter')->name('getFilter');
    Route::get('/getLeader', 'HomeController@getLeader')->name('getLeader');
    Route::get('/getHead', 'HomeController@getHead')->name('getHead');
    
});

