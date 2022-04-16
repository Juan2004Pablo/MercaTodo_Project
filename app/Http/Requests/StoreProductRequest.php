<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'max:100'],
            //'images.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'category_id' => ['required'],
            'price' => ['required', 'integer', 'min:1'],
            'quantity' => ['required', 'integer', 'min:0'],
            'description' => ['required', 'min:10', 'max:250'],
            'status' => ['required', 'in:New, Used'],
        ];
    }
}