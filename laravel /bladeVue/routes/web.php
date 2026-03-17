<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin-panel', function () {
    return Inertia::render('Test');
})->middleware(['auth'])->name('admin-panel');

Route::get('/roles-and-permissions', function () {
    return Inertia::render('Admin/RolesAndPermissions');
})->middleware(['auth'])->name('roles-and-permissions');

Route::get('/users', function () {
    return Inertia::render('Admin/User');
})->middleware(['auth'])->name('admin-users');

Route::get('/test-redis', function () {
    return Inertia::render('Admin/TestPage');
})->middleware(['auth'])->name('test-redis');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
