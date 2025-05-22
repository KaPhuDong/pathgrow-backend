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
use App\Http\Controllers\Api\AchievementController;
use App\Http\Controllers\Api\StudentCalendarController;
use App\Http\Controllers\Api\ClassManagementController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//auth routes
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

//goals routes
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

// student profile routes
Route::middleware(['auth:sanctum', 'role:student'])->group(function () {
    Route::get('/student/profile', [StudentController::class, 'profile']);
});

// semester routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/semesters', [SemesterController::class, 'index']);
});

// subject routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/subjects', [SubjectController::class, 'index']);
});

//study plan inclass routes
Route::get('/inclass', [JournalInclassController::class, 'index']);
Route::post('/inclass', [JournalInclassController::class, 'store']);
Route::put('/inclass/{id}', [JournalInclassController::class, 'update']);
Route::delete('/inclass/{id}', [JournalInclassController::class, 'destroy']);

//study plan selfstudy routes
Route::prefix('selfstudy')->group(function () {
    Route::get('/', [JournalSelfstudyController::class, 'index']);
    Route::get('/{id}', [JournalSelfstudyController::class, 'show']);
    Route::post('/', [JournalSelfstudyController::class, 'store']);
    Route::put('/{id}', [JournalSelfstudyController::class, 'update']);
    Route::delete('/{id}', [JournalSelfstudyController::class, 'destroy']);
});

//student account routes
Route::prefix('student/account')->group(function () {
    Route::get('/', [StudentController::class, 'getProfile']);
    Route::post('/update', [StudentController::class, 'updateProfile']);
    Route::post('/change-password', [StudentController::class, 'changePassword']);
});

//notification routes (BỎ middleware để test không cần login)
Route::prefix('notifications')->group(function () {
    Route::get('/', [NotificationsController::class, 'index']);
    Route::get('{id}', [NotificationsController::class, 'getByUser']);
    Route::post('/', [NotificationsController::class, 'store']);
    Route::put('{id}/read', [NotificationsController::class, 'markAsRead']);
    Route::delete('{id}', [NotificationsController::class, 'destroy']);
});

//classes routes
Route::apiResource('classes', ClassController::class);
Route::get('/list-student/class/{classId}', [ListStudentController::class, 'listByClass']);

//teacher routes
Route::apiResource('classes', ClassController::class);
Route::get('/list-student/class/{classId}', [ListStudentController::class, 'listByClass']);

//admin routes
Route::prefix('admin')->middleware('auth:sanctum')->group(function () {
    Route::get('/users', [AdminController::class, 'index']);
    Route::post('/users', [AdminController::class, 'store']);
    Route::get('/users/{id}', [AdminController::class, 'show']);
    Route::put('/users/{id}', [AdminController::class, 'update']);
    Route::delete('/users/{id}', [AdminController::class, 'destroy']);
});

//Achievement routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/achievements', [AchievementController::class, 'index']);
    Route::post('/achievements', [AchievementController::class, 'store']);
    Route::put('/achievements/{id}', [AchievementController::class, 'update']);
    Route::delete('/achievements/{id}', [AchievementController::class, 'destroy']);
});

Route::prefix('student-calendar')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [StudentCalendarController::class, 'index']);
    Route::post('/', [StudentCalendarController::class, 'store']);
    Route::delete('{id}', [StudentCalendarController::class, 'destroy']);
});


//ClassManagement Routes
Route::prefix('classesManagement')->group(function () {
    Route::get('/', [ClassManagementController::class, 'index']);
    Route::post('/', [ClassManagementController::class, 'store']);
    Route::put('{id}', [ClassManagementController::class, 'update']);
    Route::delete('{id}', [ClassManagementController::class, 'destroy']);
    Route::get('{id}', [ClassManagementController::class, 'show']);
});

