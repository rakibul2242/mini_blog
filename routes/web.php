<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\PostController as AdminPostController;



// Public page
Route::view('/', 'welcome');

// Dashboard (requires auth)
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profile (requires auth)
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Logout route (manual POST)
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

require __DIR__ . '/auth.php';

Route::get('/blog', [PostController::class, 'index'])->name('blog.index');
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('posts', AdminPostController::class);
});