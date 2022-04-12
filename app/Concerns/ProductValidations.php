<?php

namespace App\Concerns;

trait ProductValidations
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'category' => 'required|exists:categories,name',
            'quantity' => ['required', 'numeric', 'min:0'],
            'price' => ['required', 'numeric', 'min:1'],
            'description' => ['required', 'string', 'min:10', 'max:250'],
            'image' => ['required'],
            'image.*' => [
                'image',
                //'max:200',
                //Rule::dimensions()->maxWidth(500)->maxHeight(250)->ratio(2/1),
            ],
            'status' => ['required'],
        ];
    }
}
