<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoanRequest;
use App\Http\Requests\UpdateLoanRequest;
use App\Http\Resources\LoanResource;
use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        $query = Loan::with(['book', 'member']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('member_id')) {
            $query->where('member_id', $request->member_id);
        }

        $loans = $query->latest()->paginate($request->input('per_page', 10));

        return LoanResource::collection($loans);
    }

    public function store(StoreLoanRequest $request)
    {
        $validated = $request->validated();
        $book = Book::findOrFail($validated['book_id']);

        $activeLoans = $book->loans()->where('status', 'borrowed')->count();

        if ($activeLoans >= $book->stock) {
            return response()->json([
                'message' => 'Stok buku habis.',
                'errors' => ['book_id' => ['Stok buku habis.']],
            ], 422);
        }

        $validated['status'] = 'borrowed';
        $loan = Loan::create($validated);

        return (new LoanResource($loan->load(['book', 'member'])))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Loan $loan)
    {
        return new LoanResource($loan->load(['book', 'member']));
    }

    public function update(UpdateLoanRequest $request, Loan $loan)
    {
        $loan->update($request->validated());
        return new LoanResource($loan->load(['book', 'member']));
    }

    public function destroy(Loan $loan)
    {
        $loan->delete();
        return response()->json(['message' => 'Peminjaman berhasil dihapus'], 200);
    }

    public function returnBook(Loan $loan)
    {
        if ($loan->status === 'returned') {
            return response()->json(['message' => 'Buku sudah dikembalikan.'], 422);
        }

        $fine = $loan->calculateFine(1000);

        $loan->update([
            'return_date' => now(),
            'status' => 'returned',
            'fine' => $fine,
        ]);

        return response()->json([
            'message' => 'Buku dikembalikan.',
            'fine' => $fine,
            'data' => new LoanResource($loan->load(['book', 'member'])),
        ]);
    }
}
