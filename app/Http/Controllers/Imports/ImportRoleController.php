<?php

namespace App\Http\Controllers\Imports;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportFileRequest;
use App\Repositories\Role\RoleRepository;

class ImportRoleController extends Controller
{
    protected $rolesRepo;

    public function __construct(RoleRepository $rolesRepository)
    {
        $this->rolesRepo = $rolesRepository;
    }

    public function import(ImportFileRequest $request)
    {
        $this->authorize('roles.import');

        $this->rolesRepo->rolesImport($request);

        return back()->with('success', 'All good!');
    }
}
