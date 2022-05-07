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
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;

class CategoriesImport implements ToModel, WithBatchInserts, WithUpserts, WithChunkReading, WithValidation, SkipsEmptyRows
{
    use Importable;
    use RemembersChunkOffset;
    use SkipsFailures;

    public function model(array $row): Category
    {
        $chunkOffset = $this->getChunkOffset();

        return new Category([
            'name' => $row[0],
            'description' => $row[1],
        ]);
    }

    public function batchSize(): int
    {
        return 20;
    }

    public function uniqueBy(): string
    {
        return 'name';
    }

    public function chunkSize(): int
    {
        return 20;
    }

    public function rules(): array
    {
        return [
            '0' => ['required', 'string', 'min:3', 'max:100'],
            '1' => ['required', 'string', 'min:10', 'max:250'],
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            '0' => 'The name is required with a minimum of 3 and a maximum of 100 characters',
            '1' => 'The description is required with a minimum of 10 and a maximum of 250 characters',
        ];
    }
}
