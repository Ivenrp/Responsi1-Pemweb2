<?php

namespace Database\Seeders;

use App\Models\Loan;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Database\Seeder;

class LoanSeeder extends Seeder
{
    public function run(): void
    {
        $members = Member::take(5)->get();
        $books = Book::take(6)->get();

        if ($members->isEmpty() || $books->isEmpty()) return;

        $data = [
            ['member' => 0, 'book' => 0, 'loan_date' => now()->subDays(10), 'due_date' => now()->subDays(3), 'status' => 'late'],
            ['member' => 1, 'book' => 1, 'loan_date' => now()->subDays(5), 'due_date' => now()->addDays(2), 'status' => 'borrowed'],
            ['member' => 2, 'book' => 2, 'loan_date' => now()->subDays(15), 'due_date' => now()->subDays(8), 'return_date' => now()->subDays(6), 'status' => 'returned'],
            ['member' => 3, 'book' => 3, 'loan_date' => now()->subDays(2), 'due_date' => now()->addDays(5), 'status' => 'borrowed'],
        ];

        foreach ($data as $d) {
            $member = $members[$d['member']] ?? null;
            $book = $books[$d['book']] ?? null;
            if (!$member || !$book) continue;

            Loan::create([
                'member_id' => $member->id,
                'book_id' => $book->id,
                'loan_date' => $d['loan_date'],
                'due_date' => $d['due_date'],
                'return_date' => $d['return_date'] ?? null,
                'status' => $d['status'],
                'fine' => $d['status'] === 'late' ? 3000 : 0,
            ]);
        }
    }
}
