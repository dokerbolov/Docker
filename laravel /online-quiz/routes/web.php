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

Route::get('/questionnaires', function () {
    return Inertia::render('Questionnaires');
})->name('questionnaires');

Route::get('/questionnaire/{id}', function () {
    return Inertia::render('Questionnaire');
})->name('questionnaire');

Route::middleware('auth')->group(function () {
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/questionnaire/room/{id}', function () {
    return Inertia::render('QuestionnaireRoom');
})->name('questionnaire.room');

Route::get('/results/room/{id}', function () {
    return Inertia::render('ResultsRoom');
})->name('results.room');

require __DIR__.'/auth.php';
