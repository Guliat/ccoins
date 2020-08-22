<?php

use Illuminate\Support\Facades\Route;

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
});

// TRADES

// COINS
Route::get('/coins', 'CoinsController@index')->name('coins.index');
Route::get('/coins/create', 'CoinsController@create')->name('coins.create');
Route::get('/coins/edit/{coins}', 'CoinsController@edit')->name('coins.edit');
Route::post('/coins/store', 'CoinsController@store')->name('coins.store');
Route::put('/coins/update/{coins}', 'CoinsController@update')->name('coins.update');
Route::put('/coins/delete/{coins}', 'CoinsController@delete')->name('coins.delete');

// EXCHANGES
Route::get('/exchanges', 'ExchangesController@index')->name('exchanges.index');
Route::get('/exchanges/create', 'ExchangesController@create')->name('exchanges.create');
Route::get('/exchanges/edit/{exchanges}', 'ExchangesController@edit')->name('exchanges.edit');
Route::post('/exchanges/store', 'ExchangesController@store')->name('exchanges.store');
Route::put('/exchanges/update/{exchanges}', 'ExchangesController@update')->name('exchanges.update');
Route::put('/exchanges/delete/{exchanges}', 'ExchangesController@delete')->name('exchanges.delete');
