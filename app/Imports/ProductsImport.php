<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToCollection, WithChunkReading, WithValidation, SkipsEmptyRows, WithHeadingRow
{
    use Importable;
    use RemembersChunkOffset;
    use SkipsFailures;

    public function collection(Collection $rows)
    {
        $chunkOffset = $this->getChunkOffset();

        $urlimages = [];

        $urlimages[]['url'] = 'images\logos\ImageDefault.jpeg';

        foreach ($rows as $row) {
            $product = new Product([
                'id' => $row['id'],
                'name' => $row['name'],
                'description' => $row['description'],
                'price' => $row['price'],
                'quantity' => $row['quantity'],
                'disable_at' => $row['disable_at'],
                'category_id' => $row['category_id'],
                'status' => $row['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $productExist = Product::where('id', $row['id'])->first();

            if ($productExist === null) {
                $product->save();

                $product->images()->imageable_id = $product->id;

                $product->images()->createMany($urlimages);
            } else {
                $productExist->name = $row['name'];
                $productExist->description = $row['description'];
                $productExist->price = $row['price'];
                $productExist->quantity = $row['quantity'];
                $productExist->disable_at = $row['disable_at'];
                $productExist->category_id = $row['category_id'];
                $productExist->status = $row['status'];
                $productExist->updated_at = now();

                $productExist->save();
            }
        }
    }

    public function batchSize(): int
    {
        return 20;
    }

    public function chunkSize(): int
    {
        return 20;
    }

    public function rules(): array
    {
        return [
            'id' => ['required', 'numeric'],
            'name' => ['required', 'min:3', 'max:100'],
            'description' => ['required', 'min:10', 'max:250'],
            'price' => ['required', 'numeric', 'min:1'],
            'quantity' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'numeric', 'exists:categories,id'],
            'status' => ['required', Rule::in(['New', 'Used'])],
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            'id' => 'The id is required and must be of type numeric',
            'description' => 'The description is required with a minimum of 10 and a maximum of 250 characters',
            'price' => 'The price is required and must be a number greater than 0',
            'quantity' => 'The amount is required and must be a number greater than or equal to 0',
            'category_id' => 'The category id is required and must exist',
            'status' => 'The status of the product is required and must be new or used',
        ];
    }
}
