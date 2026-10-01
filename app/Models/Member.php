<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nis_nim',
        'email',
        'phone',
        'address',
        'status',
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
