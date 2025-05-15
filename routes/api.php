<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GoalController;
use App\Http\Controllers\Api\JournalInclassController;
use App\Http\Controllers\Api\JournalSelfstudyController;
use App\Http\Controllers\Api\NotificationsController;
use App\Http\Controllers\Api\GoalQuestionController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

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

//route study plan Inclass
Route::get('/inclass', [JournalInclassController::class, 'index']);
Route::post('/inclass', [JournalInclassController::class, 'store']);
Route::put('/inclass/{id}', [JournalInclassController::class, 'update']);
Route::delete('/inclass/{id}', [JournalInclassController::class, 'destroy']);

//route study plan selfStudy
Route::get('/selfstudy', [JournalSelfstudyController::class, 'index']);
Route::get('/selfstudy/{id}', [JournalSelfstudyController::class, 'show']);
Route::get('/selfstudy-journal/{journalId}', [JournalSelfstudyController::class, 'listByJournal']);
Route::post('/selfstudy', [JournalSelfstudyController::class, 'store']);
Route::put('/selfstudy/{id}', [JournalSelfstudyController::class, 'update']);
Route::delete('/selfstudy/{id}', [JournalSelfstudyController::class, 'destroy']);


//route notification (BỎ middleware để test không cần login)
Route::prefix('notifications')->group(function () {
    Route::get('/', [NotificationsController::class, 'index']);
    Route::get('{id}', [NotificationsController::class, 'getByUser']);
    Route::post('/', [NotificationsController::class, 'store']);
    Route::put('{id}/read', [NotificationsController::class, 'markAsRead']);
    Route::delete('{id}', [NotificationsController::class, 'destroy']);
});
