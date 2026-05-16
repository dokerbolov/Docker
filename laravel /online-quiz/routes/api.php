<?php

use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\QuestionsAnswersController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\ResultsController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebSocketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('topic')->controller(TopicController::class)->group(function () {
    Route::get('/', 'get');
    Route::get('{id}', 'getById');
    Route::post('/create', 'create');
    Route::post('/update', 'update');
    Route::delete('/{id}', 'delete');
});

Route::prefix('questions')->controller(QuestionsController::class)->group(function () {
    Route::get('/', 'get');
    Route::get('{id}', 'getById');
    Route::post('/create', 'create');
    Route::post('/update', 'update');
    Route::delete('/{id}', 'delete');
});

Route::prefix('questions-answers')->controller(QuestionsAnswersController::class)->group(function () {
    Route::get('/', 'get');
    Route::get('{id}', 'getById');
    Route::post('/create', 'create');
    Route::post('/update', 'update');
    Route::delete('/{id}', 'delete');
});

Route::prefix('questionnaire')->controller(QuestionnaireController::class)->group(function () {
    Route::get('/', 'get');
    Route::get('{id}', 'getById');
    Route::post('/create', 'create');
    Route::post('/update', 'update');
    Route::delete('/{id}', 'delete');
    Route::post('/add-questions', 'addQuestions');
    Route::post('/delete-questions', 'deleteQuestions');
    Route::post('/rate', 'rate');
});

Route::prefix('results')->controller(ResultsController::class)->group(function () {
    Route::get('/', 'get');
    Route::get('/{id}', 'getById');
    Route::get('/user/{id}', 'getByUserId');
    Route::get('/room/{id}', 'getByRoomId');
    Route::get('/questionnaire/{id}', 'getByQuestionnaireId');
    Route::post('/create', 'create');
    Route::post('/update', 'update');
    Route::delete('/{id}', 'delete');

    Route::post('/submit-questionnaire', 'submitQuestionnaire');
    Route::post('/submit-questionnaire-room', 'submitQuestionnaireRoom');
});

Route::prefix('users')->controller(UserController::class)->group(function () {
    Route::get('/', 'get');
    Route::get('{id}', 'getById');
});

Route::prefix('websocket')->controller(WebSocketController::class)->group(function () {
    Route::post('/start-survey', 'startSurvey');
    Route::post('/room-online-users', 'getOnlineUsersRoom');
    Route::post('/room-data', 'getRoomData');
    Route::post('/create-room', 'createRoom');
});
