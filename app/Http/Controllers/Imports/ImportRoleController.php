<?php

namespace App\Http\Controllers\Imports;

use App\Http\Controllers\Controller;
use App\Repositories\Role\RoleRepository;
use Illuminate\Http\Request;

class ImportRoleController extends Controller
{
    protected $rolesRepo;

    public function __construct(RoleRepository $rolesRepository)
    {
        $this->rolesRepo = $rolesRepository;
    }

    public function import(Request $request)
    {
        $this->authorize('roles.import');

        $this->rolesRepo->rolesImport($request);

        return back()->with('success', 'All good!');
    }
}
