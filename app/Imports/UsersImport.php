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
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToModel, WithBatchInserts, WithUpserts, WithChunkReading, WithValidation, SkipsEmptyRows, WithHeadingRow
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

        $role = DB::table('roles')->where('name', $row['role'])->first();

        $users->roles()->sync([$role->id]);
    }

    private function ToModel(array $row): User
    {
        $chunkOffset = $this->getChunkOffset();

        $user = new User([
            'name' => $row['name'],
            'surname' => $row['surname'],
            'identification' => $row['identification'],
            'address' => $row['address'],
            'phone' => $row['phone'],
            'email' => $row['email'],
            'password' => Hash::make($row['password']),
            'role' => $row['role'],
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
        return 'id';
    }

    public function chunkSize(): int
    {
        return 20;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'surname' => ['required', 'string', 'max:100'],
            'identification' => ['required', 'numeric', 'unique:users'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'numeric'],
            'email' => ['required', 'email:rfc,dns', 'max:250', 'unique:users'],
            'role' => ['required', 'exists:roles,name'],
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            'id' => 'The id is required',
            'name' => 'The name is required with a maximum of 100 characters',
            'surname' => 'The surname is required with a maximum of 100 characters',
            'identification' => 'The identification is required and must be unique and numeric',
            'address' => 'The address is required with a minimum of 5 and a maximum of 50 characters',
            'phone' => 'The phone is required with a minimum of 7 and a maximum of 10 characters',
            'email' => 'The email is required with a maximum of 250 characters and must be unique',
            'password' => 'The password is required with a minimum of 5 and a maximum of 10 characters',
            'role' => 'The name role is required and must exist',
        ];
    }
}
