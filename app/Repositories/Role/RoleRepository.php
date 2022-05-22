<?php

namespace App\Repositories\Role;

use App\Exports\RolesExport;
use App\Imports\RolesImport;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class RoleRepository extends BaseRepository
{
    public function getModel(): Role
    {
        return new Role();
    }

    public function getAllRoles(): LengthAwarePaginator
    {
        return $this->getModel()->orderBy('id', 'Asc')->paginate(env('PAGINATE'));
    }

    public function permissionCreate(): Collection
    {
        return Permission::get();
    }

    public function storeRole(Request $data): object
    {
        $role = Role::create(['name' => $data->name]);

        $role->syncPermissions($data->get('permission'));

        Log::channel('contlog')->info('The role: ' . $role->name . ' has been created by: ' . Auth::user()->name . ' ' . Auth::user()->surname);

        return $role;
    }

    public function rolePermissions(Role $role)
    {
        $roleHasPermissions = [];
        foreach ($role->permissions as $permission) {
            $roleHasPermissions[] = $permission->id;
        }

        return $roleHasPermissions;
    }

    public function updateRole(Request $data, Role $role): Role
    {
        $role->name = $data->name;
        $role->syncPermissions($data->get('permission'));
        $role->save();

        Log::channel('contlog')->info('The user ' . Auth::user()->name . ' ' . Auth::user()->surname . ' has updated the role: ' . $role->name);

        return $role;
    }

    public function deleteRole(Role $role): RedirectResponse
    {
        $exist = DB::table('model_has_roles')->select('role_id', 'model_id')->where('role_id', $role->id)
            ->where('model_id', auth()->user()->id)->first();

        if ($exist === null) {
            $this->delete($role);

            return redirect()->route('role.index')->with('status_success', 'Role successfully removed');
        } else {
            return redirect()->route('role.index')->with('status_success', 'The role cannot be removed, there is at least one user with that role');
        }
    }

    public function rolesExport(): BinaryFileResponse
    {
        Log::channel('contlog')->info('The user ' . Auth::user()->name . ' ' . Auth::user()->surname . ' has exported a list of roles for possible modification');

        return (new RolesExport())->download('roles.xlsx');
    }

    public function rolesImport(Request $request): void
    {
        $file = $request->file('file');
        $import = new RolesImport();

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
