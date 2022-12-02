<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\JamuController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
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

// route middleware untuk admin agar hanya admin yang bisa mengakses halaman user
Route::middleware(['auth', 'admin'])->group(function () {
    // rute untuk UserController
    Route::resource('user',UserController::class);  
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route middleware untuk admin dan editor agar bisa mengakses halaman dalam website
Route::middleware(['auth'])->group(function () {
    // rute untuk CategoryController
    Route::resource('category',CategoryController::class);
    
    // rute untuk ProdukController
    Route::resource('produk',ProdukController::class);
    
    // rute untuk PostController
    Route::resource('post',PostController::class);
    
    // rute untuk JamuController
    Route::resource('jamu',JamuController::class);
});

