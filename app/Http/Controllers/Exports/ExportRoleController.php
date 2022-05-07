<?php

namespace App\Http\Controllers\Exports;

use App\Http\Controllers\Controller;
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
