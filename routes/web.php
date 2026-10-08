<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ============================================================
// PUBLIC ROUTES — Bisa diakses tanpa login
// ============================================================

// Root: redirect ke katalog buku publik
Route::get('/', function () {
    return redirect()->route('books.index');
});

// Katalog buku — public
Route::get('books', [BookController::class, 'index'])->name('books.index');

// ⚠️ PENTING: route statis (/create) HARUS di atas route dinamis (/{book})
// Biar Laravel nggak salah nangkep 'create' sebagai {book}

// Buku — create (admin/staff only)
Route::middleware(['auth', 'role:admin,staff'])->group(function () {
    Route::get('books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('books', [BookController::class, 'store'])->name('books.store');
});

// Buku — show (public, ditaruh SETELAH create)
Route::get('books/{book}', [BookController::class, 'show'])->name('books.show');

// ============================================================
// AUTH ROUTES — Butuh login
// ============================================================

Route::middleware(['auth'])->group(function () {

    // Dashboard — semua user login
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ============================================================
    // ADMIN + STAFF ONLY
    // ============================================================
    Route::middleware(['role:admin,staff'])->group(function () {

        // Kategori
        Route::resource('categories', CategoryController::class);

        // Buku — edit, update, destroy (index, show, create, store udah di atas)
        Route::get('books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
        Route::put('books/{book}', [BookController::class, 'update'])->name('books.update');
        Route::patch('books/{book}', [BookController::class, 'update']);
        Route::delete('books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

        // Anggota
        Route::resource('members', MemberController::class);
        Route::patch('members/{member}/suspend', [MemberController::class, 'suspend'])
            ->name('members.suspend');

        // Peminjaman
        Route::resource('loans', LoanController::class);
        Route::post('loans/{loan}/return', [LoanController::class, 'returnBook'])
            ->name('loans.return');
    });
});

require __DIR__ . '/auth.php';
