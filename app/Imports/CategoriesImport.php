<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;

class CategoriesImport implements ToModel, WithBatchInserts, WithUpserts, WithChunkReading, WithValidation, SkipsEmptyRows, WithHeadingRow
{
    use Importable;
    use RemembersChunkOffset;
    use SkipsFailures;

    public function model(array $row): Category
    {
        $chunkOffset = $this->getChunkOffset();

        return new Category([
            'name' => $row['name'],
            'description' => $row['description'],
        ]);
    }

    public function batchSize(): int
    {
        return 20;
    }

    public function uniqueBy(): string
    {
        return 'id';
    }

    public function chunkSize(): int
    {
        return 20;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'description' => ['required', 'string', 'min:10', 'max:250'],
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            'name' => 'The name is required with a minimum of 3 and a maximum of 100 characters and must be unique in categories table',
            'description' => 'The description is required with a minimum of 10 and a maximum of 250 characters',
        ];
    }
}
