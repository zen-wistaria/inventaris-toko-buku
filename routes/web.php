<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BookItemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;

Route::get('login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'authenticate']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('admin', [DashboardController::class, 'index'])->name('dashboard')->middleware('can:admin');
Route::get('welcome', [DashboardController::class, 'welcome'])->name('welcome')->middleware('auth');

Route::prefix('user')->middleware('can:admin')->group(function () {
    Route::patch('/', [UserController::class, 'update'])->name('user.update');
    Route::post('register', [UserController::class, 'store'])->name('user.register');
    Route::delete('{user}', [UserController::class, 'destroy'])->name('user.destroy');
});

Route::prefix('books')->middleware('can:pengelola')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('books.index');
    Route::post('/', [BookController::class, 'store'])->name('books.store');
    Route::patch('/', [BookController::class, 'update'])->name('books.update');
    // Route::get('{book}', [BookController::class, 'edit'])->name('books.edit');
    Route::delete('{book:slug}', [BookController::class, 'destroy'])->name('books.destroy');
});

Route::prefix('entry')->middleware('can:pengelola')->group(function () {
    Route::get('/', [BookItemController::class, 'index'])->name('entry.index');
    Route::post('/', [BookItemController::class, 'store'])->name('entry.store');
    Route::patch('/', [BookItemController::class, 'update'])->name('entry.update');
    Route::get('create', [BookItemController::class, 'create'])->name('entry.create');
    Route::delete('{book_items}', [BookItemController::class, 'destroy'])->name('entry.destroy');
});

Route::prefix('transactions')->middleware('can:kasir')->group(function () {
    Route::get('/', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/', [TransactionController::class, 'store'])->name('transactions.store');
    Route::patch('/', [TransactionController::class, 'update'])->name('transactions.update');
    Route::get('create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::get('details/{transactionsCode}', [TransactionController::class, 'details'])->name('transactions.details');
    Route::delete('{transactions}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
});
