<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GoalController;
use App\Http\Controllers\Api\JournalInclassController;
use App\Http\Controllers\Api\JournalSelfstudyController;
use App\Http\Controllers\Api\NotificationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});
Route::apiResource('goals', GoalController::class);

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


//route notification
Route::get('/notifications', [NotificationController::class, 'index']);
Route::get('/notifications/user/{userId}', [NotificationController::class, 'getByUser']);
Route::get('/notifications/{id}', [NotificationController::class, 'show']);
Route::post('/notifications', [NotificationController::class, 'store']);
Route::put('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
Route::delete('/notifications/{id}', [NotificationController::class, 'destroy']);
