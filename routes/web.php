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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/renda', [App\Http\Controllers\HomeController::class, 'store']);

//=============================================================== Despesas  
Route::post('/despesas', [App\Http\Controllers\HomeController::class, 'storeDespesa']);
Route::delete('/despesas/{id}', [App\Http\Controllers\HomeController::class,'destroyDespesa']);
//-------------------------------------------------------------------------------------//
Route::get('/despesas/edit/{id}', [App\Http\Controllers\HomeController::class,'atualizaDespesa']);
Route::put('/despesas/update/{id}', [App\Http\Controllers\HomeController::class,'updateDespesa']);
//-------------------------------------------------------------------------------------//



//=============================================================== Categoria
Route::post('/categorias', [App\Http\Controllers\HomeController::class, 'storeCategoria']);
Route::get('/categorias/edit/{id}', [App\Http\Controllers\HomeController::class,'editCategoria']);
Route::put('/categorias/update/{id}', [App\Http\Controllers\HomeController::class,'updateCategoria']);
Route::delete('/categorias/{id}', [App\Http\Controllers\HomeController::class,'destroyCategoria']);