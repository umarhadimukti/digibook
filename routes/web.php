<?php

use App\Http\Controllers\User\KategoriController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\BookController;
use App\Http\Controllers\User\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::redirect('/', '/login');
Route::redirect('/', 'dashboard');

// routing untuk user biasa
Route::prefix('dashboard')->name('user.dashboard.')->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('books');
    Route::get('/book/{book:slug}', [BookController::class, 'show'])->name('book');
    Route::get('/categories', [KategoriController::class, 'index'])->name('categories');
    Route::get('/category/{category:slug}', [KategoriController::class, 'show'])->name('category.detail');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});
