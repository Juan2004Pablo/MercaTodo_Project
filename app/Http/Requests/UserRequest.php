<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'alpha_num', 'max:100'],
            'surname' => ['required', 'alpha_num', 'max:100'],
            'identification' => ['required', 'numeric', 'min:8', 'max:10', 'unique:users,identification,'],
            'address' => ['required', 'max:50,'],
            'phone' => ['required', 'numeric', 'min:10', 'max:10,'],
            'email' => ['required', 'email:rfc,dns', 'max:250'],
        ];
    }
}
