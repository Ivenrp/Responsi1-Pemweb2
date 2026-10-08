<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\LoanController;

// ==========================================
// 1. RUTE PUBLIK (Tidak perlu login)
// ==========================================
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// ==========================================
// 2. RUTE UMUM (Wajib login untuk semua user)
// ==========================================
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    
    // User biasa / anggota hanya diizinkan melihat (read-only) daftar buku dan kategori
    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/{book}', [BookController::class, 'show']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{category}', [CategoryController::class, 'show']);
});

// ==========================================
// 3. RUTE KHUSUS ADMIN (Wajib login + Middleware 'admin')
// ==========================================
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    
    // Fitur Anggota & Proses Bisnis Suspend (Tugas Javier - Hanya Admin yang bisa atur anggota)
    Route::patch('/members/{member}/suspend', [MemberController::class, 'suspend']);
    Route::apiResource('members', MemberController::class);

    // Manajemen Kategori (Admin bisa tambah, edit, hapus)
    Route::apiResource('categories', CategoryController::class)->except(['index', 'show']);

    // Manajemen Buku (Admin bisa tambah, edit, hapus)
    Route::apiResource('books', BookController::class)->except(['index', 'show']);

    // Manajemen Peminjaman & Pengembalian Buku
    Route::post('/loans/{loan}/return', [LoanController::class, 'returnBook']);
    Route::apiResource('loans', LoanController::class);
});