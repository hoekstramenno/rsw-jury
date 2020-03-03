<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'start_number' => 'required|number',
            'name' => 'required|string',
            'won_first_place' => 'required|boolean',
            'won_motivation_award' => 'required|boolean',
            'won_theme_award' => 'required|boolean',
            'is_active' => 'required|boolean',
            'outside_competition' => 'required|boolean',
            'group_id' => 'required|exists:groups',
            'year_id' => 'required|exists:years',
        ];
    }
}
