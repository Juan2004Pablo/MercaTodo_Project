<?php

namespace App\Http\Controllers;

use App\Repositories\Role\RoleRepository;

class ExportRoleController extends Controller
{
    protected $rolesRepo;

    public function __construct(RoleRepository $rolesRepository)
    {
        $this->rolesRepo = $rolesRepository;
    }

    public function export()
    {
        $this->authorize('roles.export');

        return $this->rolesRepo->rolesExport();
    }
}
