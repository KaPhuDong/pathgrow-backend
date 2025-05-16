<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GoalController;
use App\Http\Controllers\Api\JournalInclassController;
use App\Http\Controllers\Api\JournalSelfstudyController;
use App\Http\Controllers\Api\NotificationsController;
use App\Http\Controllers\Api\GoalQuestionController;
use App\Http\Controllers\Api\ClassController;
use App\Http\Controllers\Api\ListStudentController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\SemesterController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TeacherController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::prefix('goals')->middleware('auth:sanctum')->group(function () {
    Route::get('{semester}/{subject}', [GoalController::class, 'show']);
    Route::post('{semester}/{subject}', [GoalController::class, 'store']);
    Route::put('{semester}/{subject}', [GoalController::class, 'update']);
});

Route::prefix('goal-questions')->middleware('auth:sanctum')->group(function () {
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
Route::prefix('selfstudy')->group(function () {
    Route::get('/', [JournalSelfstudyController::class, 'index']);
    Route::get('/{id}', [JournalSelfstudyController::class, 'show']);
    Route::post('/', [JournalSelfstudyController::class, 'store']);
    Route::put('/{id}', [JournalSelfstudyController::class, 'update']);
    Route::delete('/{id}', [JournalSelfstudyController::class, 'destroy']);
});