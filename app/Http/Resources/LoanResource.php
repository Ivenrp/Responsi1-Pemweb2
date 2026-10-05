<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'loan_date' => $this->loan_date?->format('Y-m-d'),
            'due_date' => $this->due_date?->format('Y-m-d'),
            'return_date' => $this->return_date?->format('Y-m-d'),
            'status' => $this->status,
            'is_late' => $this->isLate(),
            'fine' => $this->fine,
            'member' => $this->whenLoaded('member', fn() => [
                'id' => $this->member->id,
                'name' => $this->member->name,
                'nis_nim' => $this->member->nis_nim,
            ]),
            'book' => $this->whenLoaded('book', fn() => [
                'id' => $this->book->id,
                'title' => $this->book->title,
                'author' => $this->book->author,
            ]),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
