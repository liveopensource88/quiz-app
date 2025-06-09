<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;

/*
|--------------------------------------------------------------------------
| API Routes (JSON API)
|--------------------------------------------------------------------------
*/

// Public quizzes and categories
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/quizzes/{id}', [QuizController::class, 'show']);

// Protected routes - require authentication
Route::middleware('auth:sanctum')->group(function () {

    // Current logged-in user info
    Route::get('/me', [UserController::class, 'me']);

    // Admin API routes - protected by AdminMiddleware
    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::get('/categories', [CategoryController::class, 'index']);
        Route::post('/categories', [CategoryController::class, 'store']);
        Route::get('/categories/{id}', [CategoryController::class, 'show']);
        Route::put('/categories/{id}', [CategoryController::class, 'update']);
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
        
        Route::apiResource('/admin/categories', CategoryController::class);
        Route::apiResource('/admin/quizzes', QuizController::class);
        Route::apiResource('/admin/questions', QuestionController::class);
        Route::get('/admin/results', [ResultController::class, 'index']);
        Route::get('/admin/users', [UserController::class, 'index']);
    });

    // User routes
    Route::post('/quizzes/{id}/submit', [QuizController::class, 'submit']);
    Route::get('/my-results', [ResultController::class, 'myResults']);
});
