<?php

namespace App\Http\Requests\Admin\Products;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'alpha_num', 'max:100'. $user->id],
            'surname' => ['required', 'alpha_num', 'max:100'. $user->id],
            'identification' => ['required', 'numeric', 'min:8', 'max:10', 'unique:users,identification,' . $user->id],
            'address' => ['required','max:50,' . $user->id],
            'phone' => ['required', 'numeric', 'min:10', 'max:10,' . $user->id],
            'email' => ['required', 'email:rfc,dns', 'max:250'. $user->id]
        ];
    }
}
