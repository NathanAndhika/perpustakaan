<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReadingHistoryController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FavoriteController;
Route::get('/', function () {
    return view('welcome');
});

// Route bantuan untuk membuat symlink di hosting
Route::get('/linkstorage', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        return 'Symlink berhasil dibuat! Silakan cek web kamu.';
    } catch (\Exception $e) {
        return 'Gagal membuat symlink: ' . $e->getMessage();
    }
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::middleware('is_admin')->group(function () {
        Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::resource('categories', CategoryController::class);
        Route::resource('books', BookController::class)->except(['index', 'show']);
        Route::get('/admin/history', [ReadingHistoryController::class, 'adminIndex'])->name('admin.history');
    });

    Route::get('/books/{book}/read', [BookController::class, 'read'])->name('books.read');
    Route::get('/books/{book}/download', [BookController::class, 'download'])->name('books.download');
    Route::resource('books', BookController::class)->only(['index', 'show']);
    // Favorites routes
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/{book}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/history', [ReadingHistoryController::class, 'index'])->name('history.index');


});

require __DIR__.'/auth.php';