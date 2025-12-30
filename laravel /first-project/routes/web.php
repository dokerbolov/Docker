<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('app');
});

Route::get('/students', [StudentController::class, 'getList'])->name('main');
Route::get('/students-edit/{id}', [StudentController::class, 'getStudent'])->name('students-edit');
Route::post('/students-create', [StudentController::class, 'create'])->name('students-create');
Route::post('/students-update', [StudentController::class, 'update'])->name('students-update');;
Route::post('/students-delete', [StudentController::class, 'delete'])->name('students-delete');;
