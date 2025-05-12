<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GoalController;

Route::post('/login', [AuthController::class, 'login']);
Route::apiResource('goals', GoalController::class);
