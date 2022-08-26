<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::resource('conversion', App\Http\Controllers\ConversionAdminController::class)->only(['index','store','show','update','destroy']);

Route::get('getServerStatus',[App\Http\Controllers\CurrencyController::class, 'getServerStatus']);

Route::get('getCurrencyPairs',[App\Http\Controllers\CurrencyController::class, 'getCurrencyPairsList']);

Route::get('getCurrencies',[App\Http\Controllers\CurrencyController::class, 'getCurrencies']);

Route::post('saveCurrencyPair',[App\Http\Controllers\CurrencyController::class, 'saveCurrencyPair']);

Route::post('saveCurrency',[App\Http\Controllers\CurrencyController::class, 'saveCurrency']);

Route::delete('deleteCurrencyPair/{id}',[App\Http\Controllers\CurrencyController::class, 'deleteCurrencyPair']);

Route::get('getCurrencyPair/{id}',[App\Http\Controllers\CurrencyController::class, 'getCurrencyPair']);

Route::post('updateCurrencyPair/{id}',[App\Http\Controllers\CurrencyController::class, 'updateCurrencyPair']);

Route::post('updateCurrencyPairCount/{id}',[App\Http\Controllers\CurrencyController::class, 'updateCurrencyPairCount']);

// Route::get('currency_pairs', 'CurrencyPairsAdminController@index');