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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->get('/authenticated', function () {
    return true;
});

Route::post('login',[App\Http\Controllers\CurrencyConverterController::class, 'login']);

Route::get('getServerStatus',[App\Http\Controllers\CurrencyConverterController::class, 'getServerStatus']);

Route::get('getCurrencyPairs',[App\Http\Controllers\CurrencyConverterController::class, 'getCurrencyPairsList']);

Route::get('getCurrencies',[App\Http\Controllers\CurrencyConverterController::class, 'getCurrencies']);

Route::post('saveCurrencyPair',[App\Http\Controllers\CurrencyConverterController::class, 'saveCurrencyPair']);

Route::post('saveCurrency',[App\Http\Controllers\CurrencyConverterController::class, 'saveCurrency']);

Route::delete('deleteCurrencyPair/{id}',[App\Http\Controllers\CurrencyConverterController::class, 'deleteCurrencyPair']);

Route::get('getCurrencyPair/{id}',[App\Http\Controllers\CurrencyConverterController::class, 'getCurrencyPair']);

Route::post('updateCurrencyPair/{id}',[App\Http\Controllers\CurrencyConverterController::class, 'updateCurrencyPair']);

Route::post('updateCurrencyPairCount/{id}',[App\Http\Controllers\CurrencyConverterController::class, 'updateCurrencyPairCount']);

// Route::get('currency_pairs', 'CurrencyPairsAdminController@index');