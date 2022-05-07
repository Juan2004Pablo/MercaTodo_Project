<?php

namespace App\Repositories\User;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class UserRepository extends BaseRepository
{
    public function getModel(): User
    {
        return new User();
    }

    public function getAllUsers(): LengthAwarePaginator
    {
        return $this->getModel()->withTrashed('roles')->orderBy('id', 'Asc')->paginate(8);
    }

    public function roleToUser(): Collection
    {
        $roles = Role::orderBy('id')->get();

        return $roles;
    }

    public function updateUser(Request $data, User $user): User
    {
        $user->update($data->all());

        $user->roles()->sync($data->get('roles'));

        Log::channel('contlog')->info('The user ' . Auth::user()->name . ' ' . Auth::user()->surname . ' has updated the user: ' . $user->name . ' ' . $user->surname);

        return $user;
    }

    public function usersExport(): BinaryFileResponse
    {
        return (new UsersExport())->download('users.xlsx');

        Log::channel('contlog')->info('The user ' . Auth::user()->name . ' ' . Auth::user()->surname . ' has exported a list of users for possible modification');
    }

    public function usersImport(Request $request): void
    {
        $file = $request->file('file');
        $import = new UsersImport();

        try {
            $import->import($file);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            foreach ($failures as $failure) {
                $failure->row(); // row that went wrong
                $failure->attribute(); // either heading key (if using heading row concern) or column index
                $failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
                dd($failure);
            }
        }
    }
}
