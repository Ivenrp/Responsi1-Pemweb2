<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Loan;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'books' => Book::count(),
            'members' => Member::count(),
            'categories' => Category::count(),
            'active_loans' => Loan::where('status', 'borrowed')->count(),
            'late_loans' => Loan::where('status', 'borrowed')
                ->where('due_date', '<', now())
                ->count(),
        ];

        $recentLoans = Loan::with(['book', 'member'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'recentLoans'));
    }
}
