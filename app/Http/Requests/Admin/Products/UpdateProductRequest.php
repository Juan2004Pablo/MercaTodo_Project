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
            'code' => ['required', 'size:6', Rule::unique('products')->ignore(optional($this->product)->id, 'id')],
            'name' => ['required', 'min:3', 'max:100'],
            'category_id' => ['required'],
            'price' => ['required', 'integer', 'min:1'],
            'quantity' => ['required', 'integer', 'min:0'],
            'description' => ['required', 'min:10', 'max:250'],
            'status' => ['required', 'in:New, Used'],
            'images.*' => [
                'image',
                //'max:200', 'mimes:jpeg,png,jpg,
                //Rule::dimensions()->maxWidth(500)->maxHeight(250)->ratio(2/1),
            ]
        ];
    }
}
