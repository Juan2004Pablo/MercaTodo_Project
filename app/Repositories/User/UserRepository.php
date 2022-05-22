<?php

namespace App\Repositories\User;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function toggleUser(User $user): void
    {
        $user->disable_at = $user->disable_at ? null : now();

        $user->save();

        if ($user->disable_at === null) {
            \Log::warning('enabled user account with id: ' . $user->id);
        } else {
            \Log::warning('disabled user account with id: ' . $user->id);
        }
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

    public function rolesSearch(Collection $users): array
    {
        $i = 0;
        $roles[] = null;
        foreach ($users as $user) {
            $roleOfModel = DB::table('model_has_roles')->where('model_id', $user->id)->first();
            $role = Role::where('id', $roleOfModel->role_id)->first();
            $roles[$i] = $role->name;
            $i++;
        }

        Log::channel('contlog')->info('The user ' . Auth::user()->name . ' ' . Auth::user()->surname . ' has generated an users report');

        return $roles;
    }

    public function usersSearch(Request $request): Collection
    {
        $users = User::whereDate('created_at', '>=', $request->get('initial-date'))
            ->whereDate('created_at', '<=', $request->get('end-date'))->orderBy('created_at', 'Asc')
            ->get(['id', 'name', 'surname', 'identification', 'address', 'phone', 'email', 'created_at']);

        return $users;
    }
}
