<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\User\KategoriController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\BookController;
use App\Http\Controllers\User\DashboardBookController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
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

// untuk user biasa dan admin
Route::prefix('dashboard')->name('user.dashboard.')->middleware(['auth', 'checkRole:1,2'])->group(function () {
    Route::get('/', [BookController::class, 'index'])->name('books');
    Route::get('/book/{book:slug}', [BookController::class, 'show'])->name('book');
    Route::get('/categories', [KategoriController::class, 'index'])->name('categories');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/export-pdf', [ProfileController::class, 'export_pdf'])->name('export');
});

// untuk dashboard buku
Route::prefix('dashboard-books')->name('dashboard.books.')->middleware(['auth', 'checkRole:1,2'])->group(function () {
    Route::resource('books', DashboardBookController::class);
    Route::get('/slug/check-slug', [DashboardBookController::class, 'checkSlug']);
});

// untuk admin kategori buku
Route::prefix('dashboard-categories')->name('dashboard.categories.')->middleware(['auth', 'checkRole:1'])->group(function () {
    Route::resource('categories', CategoryController::class)->except('show');
    Route::get('/slug/check-slug', [CategoryController::class, 'checkSlug']);
});

// untuk admin dan user biasa
Route::group(['middleware' => ['auth', 'checkRole:1,2']], function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/redirect', [RedirectController::class, 'check'])->name('redirect');
});

// untuk download file dari public storage
Route::prefix('books-download')->name('books.download.')->middleware(['auth', 'checkRole:1,2'])->group(function () {
    Route::get('/download', [DownloadController::class, 'public_download'])->name('public-download');
});
