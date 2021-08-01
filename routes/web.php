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
    return redirect('/home');
})->middleware('auth');

Route::get('/paket', [App\Http\Controllers\PaketController::class, 'index']);
Route::post('/pakets/create', [App\Http\Controllers\PaketController::class, 'store']);
Route::put('/pakets/{paket_id}', [App\Http\Controllers\PaketController::class, 'update']);
Route::delete('/pakets/{paket_id}', [App\Http\Controllers\PaketController::class, 'destroy']);

Route::get('/item', [App\Http\Controllers\ItemController::class, 'index']);
Route::get('/all_item', [App\Http\Controllers\ItemController::class, 'all_item']);
Route::post('/items/create', [App\Http\Controllers\ItemController::class, 'store']);
Route::put('/items/{item_id}', [App\Http\Controllers\ItemController::class, 'update']);
Route::delete('/items/{item_id}', [App\Http\Controllers\ItemController::class, 'destroy']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
