<?php

namespace App\Imports;

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
use Spatie\Permission\Models\Role;

class RolesImport implements ToModel, WithBatchInserts, WithUpserts, WithChunkReading, WithValidation, SkipsEmptyRows, WithHeadingRow
{
    use Importable;
    use RemembersChunkOffset;
    use SkipsFailures;

    public function model(array $row): Role
    {
        $chunkOffset = $this->getChunkOffset();

        return new Role([
            'id' => $row['id'],
            'name' => $row['name'],
            'guard_name' => 'web',
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
            'id' => ['required', 'numeric'],
            'name' => ['required', 'string', 'min:3', 'max:100'],
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            'id' => 'The id of the role is required',
            'name' => 'The name is required with a minimum of 3, a maximum of 100 characters and must be unique',
        ];
    }
}
