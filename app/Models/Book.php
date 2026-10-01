<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'isbn',
        'year',
        'category_id',
        'stock',
        'cover',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function availableStock(): int
    {
        $borrowed = $this->loans()->where('status', 'borrowed')->count();
        return max(0, $this->stock - $borrowed);
    }
}
