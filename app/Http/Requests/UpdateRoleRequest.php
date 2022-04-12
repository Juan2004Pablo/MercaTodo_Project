<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'max:100', Rule::unique('roles')],
            'description' => ['required', 'text', 'min:10', 'max:500']
        ];
    }
}
