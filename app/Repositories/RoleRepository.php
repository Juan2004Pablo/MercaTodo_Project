<?php

namespace App\Repositories\Role;

use App\Models\Permission;
use App\Models\Role;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository extends BaseRepository
{
    public function getModel(): Role
    {
        return new Role();
    }

    public function getAllRoles(): LengthAwarePaginator
    {
        return $this->getModel()->orderBy('id', 'Desc')->paginate(5);
    }

    public function storeRole(Request $data): object
    {
        $role = $this->getModel()->create($data->all());

        return $role;
    }

    public function updateRole(Request $data, Role $role): Role
    {
        $role->update($data->all());

        return $role;
    }
}
