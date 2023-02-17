<?php

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;

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

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'loginPost'])->name('login.post');
Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/home', [UserController::class, 'home'])->name('home');

    Route::prefix('items')->group(function () {
        Route::get('/', [ItemController::class, 'index'])->name('items.index');
    });
    Route::prefix('carts')->group(function () {
        Route::get('/', [ItemController::class, 'cart'])->name('carts.index');
        Route::post('/add', [ItemController::class, 'addToCart'])->name('carts.add');
        Route::post('/update', [ItemController::class, 'updateCart'])->name('carts.update');
        Route::post('/remove', [ItemController::class, 'removeFromCart'])->name('carts.remove');
    });
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::post('/create', [OrderController::class, 'createOrder'])->name('orders.create');
    });
    Route::prefix('payment')->group(function () {
        Route::get('finish', [OrderController::class, 'finishedTransaction'])->name('payment.finish');
    });
});
URL::forceScheme('https');
