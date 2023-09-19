<?php

use App\AccessMaster;
use App\Http\Controllers\AccessGroupController;
use App\Http\Controllers\AccessMasterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\MintaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Models\AccessGroup;
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
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/barang', [BarangController::class, 'index']);
    Route::resource('barang', BarangController::class);

    Route::get('/access_group', [AccessGroupController::class, 'index']);
    Route::resource('access_groups', AccessGroupController::class);

    Route::get('/access_master', [AccessMasterController::class, 'index']);
    Route::resource('access_masters', AccessMasterController::class);

    Route::get('/users', [UserController::class, 'index']);
    Route::resource('users', UserController::class);

    Route::get('/order', [OrderController::class, 'index']);
    Route::resource('order', OrderController::class);

    Route::get('/minta', [OrderController::class, 'index']);
    Route::resource('minta', MintaController::class);
});

Auth::routes();

