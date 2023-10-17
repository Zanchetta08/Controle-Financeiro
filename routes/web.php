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

Route::get('/home', [App\Http\Controllers\CategoryController::class, 'index'])->name('home');

Route::get('/categories', 'CategoryController@index');
Route::post('/categories', [App\Http\Controllers\CategoryController::class, 'store']);
Route::put('/categories/update/{id}', [App\Http\Controllers\CategoryController::class, 'update']);
Route::get('/categories/{id}', [App\Http\Controllers\CategoryController::class, 'edit']);
Route::delete('/categories/{id}', [App\Http\Controllers\CategoryController::class, 'destroy']);