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

Route::apiResource('classes', ClassController::class);
Route::get('/list-student/class/{classId}', [ListStudentController::class, 'listByClass']);

Route::prefix('admin')->middleware('auth:sanctum')->group(function () {
    Route::get('/users', [AdminController::class, 'index']);
    Route::post('/users', [AdminController::class, 'store']);
    Route::get('/users/{id}', [AdminController::class, 'show']);
    Route::put('/users/{id}', [AdminController::class, 'update']);
    Route::delete('/users/{id}', [AdminController::class, 'destroy']);
});

Route::middleware(['auth:sanctum', 'role:student'])->group(function () {
    Route::get('/student/profile', [StudentController::class, 'profile']);
});

Route::middleware(['auth:sanctum', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard']);
});

// Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
//     Route::get('/admin/users', [AdminController::class, 'index']);
// });

// Semester routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/semesters', [SemesterController::class, 'index']);
});

// Subject routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/subjects', [SubjectController::class, 'index']);
});