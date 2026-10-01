<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * @property int $id
 * @property int $member_id
 * @property int $book_id
 * @property Carbon $loan_date
 * @property Carbon $due_date
 * @property Carbon|null $return_date
 * @property string $status
 * @property int $fine
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Member $member
 * @property-read Book $book
 */
class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'book_id',
        'loan_date',
        'due_date',
        'return_date',
        'status',
        'fine',
    ];

    protected $casts = [
        'loan_date' => 'date',
        'due_date' => 'date',
        'return_date' => 'date',
    ];

    /**
     * Relasi ke Member (peminjam).
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * Relasi ke Book (buku yang dipinjam).
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function calculateFine(int $perDay = 1000): int
    {
        /** @var Carbon $dueDate */
        $dueDate = $this->due_date;

        /** @var Carbon|null $returnDate */
        $returnDate = $this->return_date;

        if ($returnDate) {
            $late = $dueDate->diffInDays($returnDate, false);
        } else {
            $late = $dueDate->diffInDays(now(), false);
        }

        return $late > 0 ? $late * $perDay : 0;
    }

    /**
     * Cek apakah peminjaman terlambat.
     */
    public function isLate(): bool
    {
        return ! $this->return_date && now()->greaterThan($this->due_date);
    }
}
