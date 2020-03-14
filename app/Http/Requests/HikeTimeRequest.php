<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HikeTimeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'start' => 'required|string',
            'end' => 'required|string',
            'team_id' => 'sometimes|exists:years',
        ];
    }
}
