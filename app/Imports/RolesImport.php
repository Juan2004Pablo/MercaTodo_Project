<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Spatie\Permission\Models\Role;

//use Illuminate\Validation\Rule;

class RolesImport implements ToModel, WithBatchInserts, WithUpserts, WithChunkReading, WithValidation, SkipsEmptyRows
{
    use Importable;
    use RemembersChunkOffset;
    use SkipsFailures;

    public function model(array $row): Role
    {
        $chunkOffset = $this->getChunkOffset();

        return new Role([
            'name' => $row[0],
            'guard_name' => $row[1],
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
        '0' => ['required', 'string', 'min:3', 'max:100'/*Rule::unique('roles')*/],
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            '0' => 'The name is required with a minimum of 3, a maximum of 100 characters and must be unique',
        ];
    }
}
