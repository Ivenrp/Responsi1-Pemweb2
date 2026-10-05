<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\LoanController;
use App\Http\Controllers\Api\MemberController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);

    // CRUD API — kasih nama route prefix 'api.' biar nggak konflik dengan web
    Route::apiResource('books', BookController::class)->names('api.books');
    Route::apiResource('categories', CategoryController::class)->names('api.categories');
    Route::apiResource('members', MemberController::class)->names('api.members');
    Route::apiResource('loans', LoanController::class)->names('api.loans');

    Route::post('loans/{loan}/return', [LoanController::class, 'returnBook'])->name('api.loans.return');
});
