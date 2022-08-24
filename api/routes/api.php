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

Route::get('currency_pairs',[App\Http\Controllers\CurrencyPairsController::class, 'currency_pairs']);