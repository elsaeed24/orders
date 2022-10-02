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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\VisitorController::class, 'index']);

Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index'])->name('cat_show');
Route::post('/category/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('cat_store');

Route::post('/category/update', [App\Http\Controllers\CategoryController::class, 'update'])->name('cat_update');


Route::get('/category/delete/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('cat_delete');

Route::get('/meal/index', [App\Http\Controllers\MealController::class, 'index'])->name('meal_index');
Route::get('/meal/show', [App\Http\Controllers\MealController::class, 'show'])->name('meal_show');
Route::get('/meal/edit/{id}', [App\Http\Controllers\MealController::class, 'edit'])->name('meal_edit');



Route::post('/meal/store', [App\Http\Controllers\MealController::class, 'store'])->name('meal_store');
Route::post('/meal/update/{id}', [App\Http\Controllers\MealController::class, 'update'])->name('meal_update');

Route::get('/meal/detailes/{id}', [App\Http\Controllers\MealController::class, 'detailes'])->name('meal_detailes');

Route::post('/order/store', [App\Http\Controllers\HomeController::class, 'order_store'])->name('order_store');

Route::get('/show/order', [App\Http\Controllers\HomeController::class, 'show_order'])->name('show_order');

Route::post('/chang/status/{id}', [App\Http\Controllers\HomeController::class, 'changeStatus'])->name('changeStatus');










Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
