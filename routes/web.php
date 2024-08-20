<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BookItemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;

Route::redirect('/', '/login');
Route::get('login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'authenticate']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('can:admin');
Route::get('welcome', [DashboardController::class, 'welcome'])->name('welcome')->middleware('auth');

Route::prefix('users')->middleware('can:admin')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::get('create', [UserController::class, 'create'])->name('users.create');
    Route::patch('{user:username}', [UserController::class, 'update'])->name('users.update');
    Route::delete('{user:username}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('{user:username}/edit', [UserController::class, 'edit'])->name('users.edit');
});

Route::prefix('books')->middleware('can:pengelola')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('books.index');
    Route::post('/', [BookController::class, 'store'])->name('books.store');
    Route::get('create', [BookController::class, 'create'])->name('books.create');
    Route::patch('{book:slug}', [BookController::class, 'update'])->name('books.update');
    Route::delete('{book:slug}', [BookController::class, 'destroy'])->name('books.destroy');
    Route::get('{book:slug}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::get('{book:slug}/details', [BookController::class, 'show'])->name('books.show');
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
    Route::get('create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::patch('{transaction:code}', [TransactionController::class, 'update'])->name('transactions.update');
    // Route::delete('{transaction:code}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
    Route::get('{transaction:code}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');
    Route::get('{transaction:code}/details', [TransactionController::class, 'show'])->name('transactions.show');
});
