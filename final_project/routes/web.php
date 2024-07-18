<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToyController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('index');
});
Route::middleware(['auth'])->group(function () {
    Route::resource('toys', ToyController::class);
    Route::resource('cart', CartController::class);
    Route::resource('invoices', InvoiceController::class);
});

Route::resource('toys', ToyController::class);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/toys', [ToyController::class, 'index'])->name('toys.index');
Route::get('/toys', [ToyController::class, 'index'])->name('toys.index');
Route::get('/toys/create', [ToyController::class, 'create'])->name('toys.create');
Route::post('/toys', [ToyController::class, 'store'])->name('toys.store');
Route::get('/toys/{toy}', [ToyController::class, 'show'])->name('toys.show');
Route::get('/toys/{toy}/edit', [ToyController::class, 'edit'])->name('toys.edit');
Route::put('/toys/{toy}', [ToyController::class, 'update'])->name('toys.update');
Route::delete('/toys/{toy}', [ToyController::class, 'destroy'])->name('toys.destroy');
Route::get('/toys/search', [ToyController::class, 'search'])->name('search');
Route::get('/toys/filter', [ToyController::class, 'filter'])->name('filter');

Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/buy', [CartController::class, 'buy'])->name('cart.buy');
Route::get('/invoice/{invoice}', [InvoiceController::class, 'show'])->name('invoice.show');
Route::post('/cart/buy', [CartController::class, 'buy'])->name('cart.buy');
Route::view('/cart/confirmation', 'cart.confirmation')->name('cart.confirmation');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('search', [ToyController::class, 'search'])->name('search');
Route::get('filter', [ToyController::class, 'filter'])->name('filter');
