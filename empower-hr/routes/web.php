<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('logout', [WebAuthController::class, 'logout'])->name('logout');

    // Your admin dashboard routes here...
    Route::middleware('role:System Administrator,HR Manager')
         ->prefix('admin')
         ->name('admin.')
         ->group(function() {
             // e.g. user management:
             Route::get('users', [\App\Http\Controllers\UserController::class, 'indexView'])->name('users.index');
            Route::get('users/create', [\App\Http\Controllers\UserController::class, 'createView'])->name('users.create');
            Route::get('users/edit', [\App\Http\Controllers\UserController::class, 'editView'])->name('users.edit');
            Route::get('users/destroy', [\App\Http\Controllers\UserController::class, 'destroyView'])->name('users.destroy');
            Route::get('users/edit', [\App\Http\Controllers\UserController::class, 'editView'])->name('users.edit');
             // ... other admin routes
         });
});
require __DIR__.'/auth.php';
