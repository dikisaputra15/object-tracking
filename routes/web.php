<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MapsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/CCI-Maps', [App\Http\Controllers\MapsController::class, 'index']);
    Route::get('/Form-Maps', [App\Http\Controllers\MapsController::class, 'formmaps']);
    Route::post('/Store-Lokasi', [App\Http\Controllers\MapsController::class, 'storelokasi']);
    Route::get('/All-Maps', [App\Http\Controllers\MapsController::class, 'allmaps']);
});
