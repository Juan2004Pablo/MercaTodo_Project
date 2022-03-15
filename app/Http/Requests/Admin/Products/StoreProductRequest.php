<?php

namespace App\Http\Requests\Admin\Products;

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
            'code' => ['required', 'size:6', Rule::unique('products')],
            'name' => ['required', 'min:3', 'max:100'],
            'price' => ['required', 'integer', 'min:1'],
            'quantity' => ['required', 'integer', 'min:0'],
            'description' => ['required', 'min:10', 'max:250'],
            'images' => ['required', 'array'],
            'images.*' => [
                'image',
                'max:200',
                Rule::dimensions()->maxWidth(500)->maxHeight(250)->ratio(2/1),
            ]
        ];
    }
}