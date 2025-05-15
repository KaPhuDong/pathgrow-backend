<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GoalController;
use App\Http\Controllers\Api\GoalQuestionController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\SemesterController;
use App\Http\Controllers\Api\SubjectController;

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


Route::middleware(['auth:sanctum', 'role:student'])->group(function () {
    Route::get('/student/profile', [StudentController::class, 'profile']);
});

Route::middleware(['auth:sanctum', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard']);
});

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::get('/admin/users', [AdminController::class, 'index']);
});

// Semester routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/semesters', [SemesterController::class, 'index']);
});

// Subject routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/subjects', [SubjectController::class, 'index']);
});