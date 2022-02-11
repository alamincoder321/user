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

Auth::routes();

Route::get('/user-list', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user-profile/{id}', [App\Http\Controllers\HomeController::class, 'show'])->name('profile');
Route::post('/user-store', [App\Http\Controllers\HomeController::class, 'store'])->name('store');
Route::post('/user-update', [App\Http\Controllers\HomeController::class, 'update'])->name('update');
Route::get('/activate', [App\Http\Controllers\HomeController::class, 'activate'])->name('activate');
Route::get('/inactivate', [App\Http\Controllers\HomeController::class, 'inactivate'])->name('inactivate');
Route::get('/usernamewise', [App\Http\Controllers\HomeController::class, 'usernamewise'])->name('usernamewise');
Route::get('/delete/{id}', [App\Http\Controllers\HomeController::class, 'destroy'])->name('destroy');
