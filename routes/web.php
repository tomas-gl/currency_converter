<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ConversionAdminController;

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

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/admin', [HomeController::class, 'index'])->middleware('auth')->name('home');
// Route::resource('admin/book', 'ConversionAdminController')->middleware('auth');

// routes sécurisées
// Route::resource('admin/books', BookAdminController::class)->middleware('auth')->parameters([
// 	'admin/books' => 'book',
// ]);

Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');
