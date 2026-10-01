<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        $query = Loan::with(['book', 'member']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $loans = $query->latest()->paginate(10)->withQueryString();

        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $books = Book::where('stock', '>', 0)->get();
        $members = Member::where('status', 'active')->get();
        return view('loans.create', compact('books', 'members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'due_date' => 'required|date|after:loan_date',
        ]);

        $book = Book::findOrFail($validated['book_id']);
        $activeLoans = $book->loans()->where('status', 'borrowed')->count();

        if ($activeLoans >= $book->stock) {
            return back()
                ->withErrors(['book_id' => 'Stok buku habis.'])
                ->withInput();
        }

        $validated['status'] = 'borrowed';
        Loan::create($validated);

        return redirect()->route('loans.index')
            ->with('success', 'Peminjaman berhasil dicatat.');
    }

    public function show(Loan $loan)
    {
        $loan->load(['book', 'member']);
        return view('loans.show', compact('loan'));
    }

    public function edit(Loan $loan)
    {
        $books = Book::all();
        $members = Member::all();
        return view('loans.edit', compact('loan', 'books', 'members'));
    }

    public function update(Request $request, Loan $loan)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'book_id' => 'required|exists:books,id',
            'loan_date' => 'required|date',
            'due_date' => 'required|date|after:loan_date',
            'status' => 'required|in:borrowed,returned,late',
        ]);

        $loan->update($validated);

        return redirect()->route('loans.index')
            ->with('success', 'Peminjaman berhasil diperbarui.');
    }

    public function destroy(Loan $loan)
    {
        $loan->delete();

        return redirect()->route('loans.index')
            ->with('success', 'Peminjaman berhasil dihapus.');
    }

    public function returnBook(Loan $loan)
    {
        if ($loan->status === 'returned') {
            return back()->with('error', 'Buku sudah dikembalikan.');
        }

        $fine = $loan->calculateFine(1000);

        $loan->update([
            'return_date' => now(),
            'status' => 'returned',
            'fine' => $fine,
        ]);

        return redirect()->route('loans.index')
            ->with('success', 'Buku dikembalikan. Denda: Rp ' . number_format($fine, 0, ',', '.'));
    }
}
