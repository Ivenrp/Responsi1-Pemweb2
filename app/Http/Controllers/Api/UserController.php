<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // 1. Menampilkan daftar semua pengguna beserta rolenya (Admin & Staff bisa melihat)
    public function index(Request $request)
    {
        $query = User::query();

        // Fitur opsional: pencarian berdasarkan nama atau email
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where('name', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%");
        }

        $users = $query->latest()->paginate($request->input('per_page', 10));

        return response()->json([
            'message' => 'Berhasil mengambil daftar pengguna',
            'data' => $users
        ]);
    }

    // 2. Mengubah role pengguna (Contoh: Member jadi Staff, atau Staff jadi Admin)
    public function updateRole(Request $request, User $user)
    {
        // Validasi input role harus sesuai dengan pilihan di database
        $validated = $request->validate([
            'role' => 'required|in:admin,staff,user',
        ]);

        // Pengaman: Mencegah admin tidak sengaja menurunkan role akunnya sendiri
        if ($request->user()->id === $user->id && $validated['role'] !== 'admin') {
            return response()->json([
                'message' => 'Gagal! Anda tidak dapat menurunkan role akun Anda sendiri.'
            ], 422);
        }

        // Update role pengguna
        $user->update([
            'role' => $validated['role']
        ]);

        return response()->json([
            'message' => "Role pengguna {$user->name} berhasil diubah menjadi {$validated['role']}.",
            'data' => $user
        ]);
    }
}