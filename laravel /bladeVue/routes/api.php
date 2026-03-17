<?php

use App\Http\Controllers\RedisController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function () {
    return 1;
});

Route::get('/test2', "App\\Http\\Controllers\\TestController@test2");
Route::get('/test3', "App\\Http\\Controllers\\TestController@test3");

Route::prefix('users')->controller(UserController::class)->group(function () {
    Route::get('/', 'get');
    Route::post('/auth', 'auth');
    Route::post('/delete', 'delete');
    Route::post('/restore', 'restore');
});

Route::prefix('role')->controller(RoleController::class)->group(function () {
    Route::get('/', 'get');
    Route::get('/name', 'getByName');
    Route::get('/id', 'getById');
    Route::post('/create', 'create');
    Route::post('/change', 'change');
    Route::post('/delete', 'delete');
});

Route::prefix('redis')->controller(RedisController::class)->group(function () {
    Route::get('/get', 'get');
    Route::post('/create', 'create');
    Route::post('/delete', 'delete');
})->middleware('auth:sanctum');


