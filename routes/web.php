<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Models\Category;

// Public home route
Route::get('/', fn () => Inertia::render('Home'))->name('home');

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', fn () => Inertia::render('Auth/Login'))->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    
    Route::get('/register', fn () => Inertia::render('Auth/Register'))->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']); // ✅ This line is required

});

// Authenticated user routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => Inertia::render('Dashboard', [
        'user' => auth()->user(),
    ]))->name('dashboard');

    Route::post('/logout', function () {
        auth()->logout();
        return redirect('/login');
    })->name('logout');

    // Admin-only routes
    Route::middleware(AdminMiddleware::class)->prefix('admin')->name('admin.')->group(function () {


        // Categories (CRUD)
        Route::get('/categories', fn () => Inertia::render('Admin/Categories/Index'))->name('categories.index');
        
        Route::get('/categories/create', fn () => Inertia::render('Admin/Categories/Create'))->name('categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{id}/edit', function ($id) {
            $category = \App\Models\Category::findOrFail($id);
            return Inertia::render('Admin/Categories/Edit', [
                'category' => $category
            ]);
        });
        Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');

        Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        // Quizzes (CRUD)
        Route::get('/quizzes', fn () => Inertia::render('Admin/Quizzes/Index'))->name('quizzes.index');
    

        Route::get('/quizzes/create', function () {
            $category = Category::all();

            return Inertia::render('Admin/Quizzes/Create', [
                'categories' => $category,
            ]);
        })->name('quizzes.create');


        Route::get('/quizzes/{id}/edit', function ($id) {
            $Quiz = \App\Models\Quiz::findOrFail($id);
            $category = Category::all();
            return Inertia::render('Admin/Quizzes/Edit', [
                'quiz' => $Quiz,
                'categories' => $category
            ]);
        });

        Route::put('/quizzes/{id}', [QuizController::class, 'update'])->name('quizzes.update');

        Route::post('/quizzes', [QuizController::class, 'store'])->name('quizzes.store');

        Route::get('/questions', fn () => Inertia::render('Admin/Questions/Index'))->name('questions.index');
        Route::get('/results', fn () => Inertia::render('Admin/Results/Index'))->name('results.index');
        Route::get('/users', fn () => Inertia::render('Admin/Users/Index'))->name('users.index');
    });
});
