<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'max:100'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'category_id' => ['required'],
            'price' => ['required', 'numeric', 'min:1'],
            'quantity' => ['required', 'numeric', 'min:0'],
            'description' => ['required', 'min:10', 'max:250'],
            'status' => ['required', 'in:New, Used'],
        ];
    }
}
