<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RemembersChunkOffset;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;

//use Illuminate\Validation\Rule;

class UsersImport implements ToModel, WithBatchInserts, WithUpserts, WithChunkReading, WithValidation, SkipsEmptyRows
{
    use Importable;
    use RemembersChunkOffset;
    use SkipsFailures;

    public function model(array $row): void
    {
        $user = $this->ToModel($row);

        $this->RoleAssignment($user, $row);
    }

    private function RoleAssignment(User $user, array $row): void
    {
        $users = User::find($user->id);

        $role = DB::table('roles')->where('name', $row[7])->first();

        $users->roles()->sync([$role->id]);
    }

    private function ToModel(array $row): User
    {
        $chunkOffset = $this->getChunkOffset();

        $user = new User([
            'name' => $row[0],
            'surname' => $row[1],
            'identification' => $row[2],
            'address' => $row[3],
            'phone' => $row[4],
            'email' => $row[5],
            'password' => Hash::make($row[6]),
            'role' => $row[7],
        ]);

        $user->save();

        return $user;
    }

    public function batchSize(): int
    {
        return 20;
    }

    public function uniqueBy(): string
    {
        return 'identification';
    }

    public function chunkSize(): int
    {
        return 20;
    }

    public function rules(): array
    {
        return [
            '0' => ['required', 'string', 'max:100'],
            '1' => ['required', 'string', 'max:100'],
            '2' => ['required', 'numeric'/*, 'min:8', 'max:10'/*Rule::unique('users')*/],
            '3' => ['required', 'string'/*, 'min:5', 'max:50,'*/],
            '4' => ['required', 'numeric'/*, 'min:7', 'max:10'*/],
            '5' => ['required', 'email:rfc,dns', 'max:250'/*Rule::unique('users')*/],
            '6' => ['required', 'min:5', 'max:10'],
            '7' => ['required'], //must exist in database
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            '0' => 'The name is required with a maximum of 100 characters',
            '1' => 'The surname is required with a maximum of 100 characters',
            '2' => 'The identification is required with a minimum of 8, a maximum of 10 characters and must be unique and numeric',
            '3' => 'The address is required with a minimum of 5 and a maximum of 50 characters',
            '4' => 'The phone is required with a minimum of 7 and a maximum of 10 characters',
            '5' => 'The email is required with a maximum of 250 characters and must be unique',
            '6' => 'The password is required with a minimum of 5 and a maximum of 10 characters',
            '7' => 'The name role is required and must exist',
        ];
    }
}
