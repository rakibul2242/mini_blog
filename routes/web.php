<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;


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

require __DIR__.'/auth.php';

Route::resource('posts', PostController::class);


// Route to show all posts
Route::get('/viewAs', [PostController::class, 'viewAs']);