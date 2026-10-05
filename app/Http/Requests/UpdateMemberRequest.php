<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $memberId = $this->route('member')?->id ?? $this->route('member');

        return [
            'name' => 'required|string|max:255',
            'nis_nim' => ['required', 'string', Rule::unique('members', 'nis_nim')->ignore($memberId)],
            'email' => ['required', 'email', Rule::unique('members', 'email')->ignore($memberId)],
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'status' => 'required|in:active,inactive',
        ];
    }
}
