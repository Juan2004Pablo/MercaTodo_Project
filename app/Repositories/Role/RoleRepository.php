<?php

namespace App\Repositories\Role;

use App\Exports\RolesExport;
use App\Imports\RolesImport;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
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

        return $role;
    }

    public function rolesExport(): BinaryFileResponse
    {
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
            }
        }
    }
}
