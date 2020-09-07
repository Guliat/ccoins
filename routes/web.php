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
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

// TRADES
Route::get('/trades/active', 'TradesController@activeTrades')->name('trades.active');
Route::get('/trades/closed', 'TradesController@closedTrades')->name('trades.closed');
Route::get('/trades/coins', 'TradesController@tradesPerCoins')->name('trades.coins');
Route::get('/trades/exchanges', 'TradesController@tradesPerExchanges')->name('trades.exchanges');
Route::get('/trades/create', 'TradesController@create')->name('trades.create');
Route::post('/trades/store', 'TradesController@store')->name('trades.store');
Route::put('/trades/update/{trades}', 'TradesController@update')->name('trades.update');
Route::put('/trades/sell/{trades}', 'TradesController@sell')->name('trades.sell');
Route::put('/trades/convert/{trades}', 'TradesController@convert')->name('trades.convert');

// COINS
Route::get('/coins', 'CoinsController@index')->name('coins.index');
Route::get('/coins/create', 'CoinsController@create')->name('coins.create');
Route::post('/coins/store', 'CoinsController@store')->name('coins.store');
Route::get('/coins/update_prices', 'CoinsController@updatePrices')->name('coins.update.prices');

// EXCHANGES
Route::get('/exchanges', 'ExchangesController@index')->name('exchanges.index');
Route::get('/exchanges/create', 'ExchangesController@create')->name('exchanges.create');
Route::post('/exchanges/store', 'ExchangesController@store')->name('exchanges.store');

// MANAGE
Route::prefix('manage')->group(function() {

  // COINS
  Route::get('/coins', 'ManageCoinsController@index')->name('manage.coins.index');
  Route::get('/coins/create', 'ManageCoinsController@create')->name('manage.coins.create');
  Route::get('/coins/edit/{coins}', 'ManageCoinsController@edit')->name('manage.coins.edit');
  Route::post('/coins/store', 'ManageCoinsController@store')->name('manage.coins.store');
  Route::put('/coins/update/{coins}', 'ManageCoinsController@update')->name('manage.coins.update');

  // EXCHANGES
  Route::get('/exchanges', 'ManageExchangesController@index')->name('manage.exchanges.index');
  Route::get('/exchanges/create', 'ManageExchangesController@create')->name('manage.exchanges.create');
  Route::get('/exchanges/edit/{exchanges}', 'ManageExchangesController@edit')->name('manage.exchanges.edit');
  Route::post('/exchanges/store', 'ManageExchangesController@store')->name('manage.exchanges.store');
  Route::put('/exchanges/update/{exchanges}', 'ManageExchangesController@update')->name('manage.exchanges.update');

});