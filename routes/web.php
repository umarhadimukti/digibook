<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\RegisterController;
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

Route::redirect('/', '/login');

// jika user belum login
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// untuk user biasa
Route::prefix('dashboard')->name('user.dashboard.')->middleware(['auth', 'checkRole:2'])->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('books');
    Route::get('/book/{book:slug}', [BookController::class, 'show'])->name('book');
    Route::get('/categories', [KategoriController::class, 'index'])->name('categories');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});

// untuk admin
Route::prefix('admin')->name('admin.dashboard.')->middleware(['auth', 'checkRole:1'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('books');
});

// untuk admin dan user biasa
Route::group(['middleware' => ['auth', 'checkRole:1,2']], function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/redirect', [RedirectController::class, 'check'])->name('redirect');
});
