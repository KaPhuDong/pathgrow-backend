<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GoalController;
use App\Http\Controllers\Api\GoalQuestionController;
use App\Http\Controllers\Api\AdminController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
// Route::gest('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::prefix('goals')->group(function () {
    Route::get('/', [GoalController::class, 'index']);
    Route::get('{id}', [GoalController::class, 'show']);
    Route::post('/', [GoalController::class, 'store']);
    Route::put('{id}', [GoalController::class, 'update']);
    Route::delete('{id}', [GoalController::class, 'destroy']);
});


Route::prefix('goal-questions')->group(function () {
    Route::get('/', [GoalQuestionController::class, 'index']);
    Route::get('{id}', [GoalQuestionController::class, 'show']);
    Route::post('/', [GoalQuestionController::class, 'store']);
    Route::put('{id}', [GoalQuestionController::class, 'update']);
    Route::delete('{id}', [GoalQuestionController::class, 'destroy']);
});

Route::prefix('admin')->group(function () {
    Route::get('/users', [AdminController::class, 'index']);
    Route::post('/users', [AdminController::class, 'store']);
    Route::get('/users/{id}', [AdminController::class, 'show']);
    Route::put('/users/{id}', [AdminController::class, 'update']);
    Route::delete('/users/{id}', [AdminController::class, 'destroy']);
});
