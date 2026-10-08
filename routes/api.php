<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\LoanController;

// Rute Publik (Tidak perlu login/token)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rute Terlindungi (Wajib pakai Bearer Token Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    
    // Auth Endpoint
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Endpoint Kategori & Buku
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('books', BookController::class);
    
    // ENDPOINT ANGGOTA (Tugas Javier)
    // Rute custom (Proses Bisnis) harus diletakkan DI ATAS apiResource
    // agar URL /members/{member}/suspend tidak tertukar dengan URL CRUD standar
    Route::patch('/members/{member}/suspend', [MemberController::class, 'suspend']);
    Route::apiResource('members', MemberController::class);

    // Endpoint Peminjaman (Proses bisnis pengembalian buku dan CRUD)
    Route::post('/loans/{loan}/return', [LoanController::class, 'returnBook']);
    Route::apiResource('loans', LoanController::class);
});