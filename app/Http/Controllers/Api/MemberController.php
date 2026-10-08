<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Http\Resources\MemberResource;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    // Mengambil semua data anggota dengan fitur pencarian dan filter
    public function index(Request $request)
    {
        // Menghitung jumlah peminjaman tiap anggota (loans_count)
        $query = Member::withCount('loans');

        // Jika ada query parameter '?search=', lakukan pencarian nama, NIS/NIM, atau email
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                    ->orWhere('nis_nim', 'like', "%{$s}%")
                    ->orWhere('email', 'like', "%{$s}%");
            });
        }

        // Jika ada parameter '?status=', filter berdasarkan status aktif/inaktif
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Urutkan dari yang terbaru dan beri paginasi (default 10 data per halaman)
        $members = $query->latest()->paginate($request->input('per_page', 10));

        // Kembalikan response menggunakan Resource agar format JSON rapi
        return MemberResource::collection($members);
    }

    // Menyimpan data anggota baru (Create)
    public function store(StoreMemberRequest $request)
    {
        // Validasi otomatis dilakukan oleh StoreMemberRequest, tinggal simpan
        $member = Member::create($request->validated());

        return (new MemberResource($member))
            ->response()
            ->setStatusCode(201); // 201 = Created
    }

    // Menampilkan detail satu anggota (Read)
    public function show(Member $member)
    {
        // Muat jumlah pinjaman beserta riwayat buku yang dipinjam
        $member->loadCount('loans')->load('loans.book');
        return new MemberResource($member);
    }

    // Mengubah data anggota (Update)
    public function update(UpdateMemberRequest $request, Member $member)
    {
        // Validasi melalui UpdateMemberRequest, lalu update ke database
        $member->update($request->validated());
        return new MemberResource($member);
    }

    // Menghapus data anggota (Delete)
    public function destroy(Member $member)
    {
        $member->delete();
        return response()->json(['message' => 'Anggota berhasil dihapus'], 200);
    }

    /**
     * ==========================================
     * PROSES BISNIS: SUSPEND ANGGOTA BERSYARAT
     * (Syarat Wajib Responsi Pemweb)
     * ==========================================
     */
    public function suspend(Member $member)
    {
        // 1. Cek apakah anggota sudah inaktif
        if ($member->status === 'inactive') {
            return response()->json([
                'message' => 'Status anggota ini sudah nonaktif.'
            ], 422); // 422 = Unprocessable Entity
        }

        // 2. Cek relasi peminjaman: Apakah masih ada buku dengan status 'borrowed' (dipinjam)?
        $hasActiveLoans = $member->loans()->where('status', 'borrowed')->exists();

        // 3. Logika penolakan jika masih ada tanggungan
        if ($hasActiveLoans) {
            return response()->json([
                'message' => 'Gagal menonaktifkan anggota. Masih ada buku yang belum dikembalikan!',
                'errors' => ['status' => ['Anggota memiliki tanggungan peminjaman aktif.']]
            ], 422);
        }

        // 4. Lolos pengecekan, ubah status anggota menjadi inactive
        $member->update(['status' => 'inactive']);

        // 5. Kembalikan response sukses
        return response()->json([
            'message' => 'Anggota berhasil dinonaktifkan.',
            'data' => new MemberResource($member)
        ]);
    }
}