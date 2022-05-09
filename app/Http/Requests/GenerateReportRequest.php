<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenerateReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'initial-date' => ['required', 'date', 'before_or_equal:now', 'after_or_equal:01/01/2021'],
            'end-date' => ['required', 'date', 'after_or_equal:initial-date', 'before_or_equal:now'],
        ];
    }
}
