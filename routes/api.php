<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SemesterGoalController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\Api\GoalQuestionController;
use App\Http\Controllers\Api\ClassController;
use App\Http\Controllers\Api\ListStudentController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\SemesterController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\AchievementController;
use App\Http\Controllers\Api\StudentCalendarController;
use App\Http\Controllers\Api\WeeklyStudyPlanController;
use App\Http\Controllers\Api\WeeklyGoalController;
use App\Http\Controllers\Api\InClassPlanController;
use App\Http\Controllers\Api\InClassSubjectController;
use App\Http\Controllers\Api\SelfStudyPlanController;
use App\Http\Controllers\Api\SelfStudySubjectController;
use App\Http\Controllers\Api\TeacherScheduleController;
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
    Route::get('{semester}/{subject}', [SemesterGoalController::class, 'show']);
    Route::post('{semester}/{subject}', [SemesterGoalController::class, 'store']);
    Route::put('{semester}/{subject}', [SemesterGoalController::class, 'update']);
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

// weekly study plan routes
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('weekly-study-plans', WeeklyStudyPlanController::class);
});

// weekly goal routes
Route::prefix('weekly-goals')->middleware('auth:sanctum')->group(function () {
    Route::get('/{weeklyStudyPlanId}', [WeeklyGoalController::class, 'index']);
    Route::post('/', [WeeklyGoalController::class, 'store']);
    Route::put('/{id}', [WeeklyGoalController::class, 'update']);
    Route::delete('/{id}', [WeeklyGoalController::class, 'destroy']);
});

// inclass plan routes
Route::apiResource('in-class-plans', InClassPlanController::class)->middleware('auth:sanctum');
// Routes for InClassSubject
Route::apiResource('in-class-subjects', InClassSubjectController::class)->middleware('auth:sanctum');

// self-study plan routes
Route::apiResource('self-study-plans', SelfStudyPlanController::class)->middleware('auth:sanctum');
// Routes for SelfStudySubject
Route::apiResource('self-study-subjects', SelfStudySubjectController::class)->middleware('auth:sanctum');


// subject routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/subjects', [SubjectController::class, 'index']);
});

//student account routes
Route::middleware('auth:sanctum')->prefix('student')->group(function () {
    Route::get('/account', [StudentController::class, 'getProfile']);
    Route::post('/account/update', [StudentController::class, 'updateProfile']);
    Route::post('/account/change-password', [StudentController::class, 'changePassword']);
});

//notification 
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/notifications', [NotificationsController::class, 'index']);
    Route::post('/notifications', [NotificationsController::class, 'store']);
    Route::patch('/notifications/{id}/read', [NotificationsController::class, 'markAsRead']);
    Route::patch('/notifications/read-all', [NotificationsController::class, 'markAllAsRead']);
    Route::delete('/notifications/{id}', [NotificationsController::class, 'destroy']);
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

//achievement routes
Route::prefix('achievements')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [AchievementController::class, 'index']);
    Route::post('/', [AchievementController::class, 'store']);
    Route::put('{id}', [AchievementController::class, 'update']);
    Route::delete('{id}', [AchievementController::class, 'destroy']);
});

//student calendar routes
Route::prefix('student-calendar')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [StudentCalendarController::class, 'index']);
    Route::post('/', [StudentCalendarController::class, 'store']);
    Route::delete('{id}', [StudentCalendarController::class, 'destroy']);
});

// //student calendar routes
// Route::middleware('auth:sanctum')->group(function () {
//     Route::apiResource('teacher-schedules', TeacherScheduleController::class);
// });

Route::prefix('teacher-schedule')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [TeacherScheduleController::class, 'index']);
    Route::post('/', [TeacherScheduleController::class, 'store']);
    Route::delete('{id}', [TeacherScheduleController::class, 'destroy']);
});

//ClassManagement Routes
Route::prefix('classesManagement')->group(function () {
    Route::get('/', [ClassManagementController::class, 'index']);
    Route::post('/', [ClassManagementController::class, 'store']);
    Route::put('{id}', [ClassManagementController::class, 'update']);
    Route::delete('{id}', [ClassManagementController::class, 'destroy']);
    Route::get('{id}', [ClassManagementController::class, 'show']);

    // Add/remove subjects
    Route::post('{id}/add-subjects', [ClassManagementController::class, 'addSubjects']);
    Route::post('{id}/remove-subjects', [ClassManagementController::class, 'removeSubjects']);

    // Add/remove students
    Route::post('{id}/add-students', [ClassManagementController::class, 'addStudents']);
    Route::post('remove-students', [ClassManagementController::class, 'removeStudents']);

    // Add/remove teachers
    Route::post('{id}/add-teachers', [ClassManagementController::class, 'addTeachers']);
    Route::post('remove-teachers', [ClassManagementController::class, 'removeTeachers']);
});
