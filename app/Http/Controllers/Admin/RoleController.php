<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use App\Repositories\RoleRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class RoleController extends Controller
{
    protected $rolesRepo;

    public function __construct(RoleRepository $rolesRepository)
    {
        $this->rolesRepo = $rolesRepository;
    }

    public function index(): View
    {
        $roles = $this->rolesRepo->getAllRoles();

        return view('role.index', compact('roles'));
    }

    public function create(): View
    {
        return view('role.create');
    }

    public function store(RoleStoreRequest $request): RedirectResponse
    {
        $this->rolesRepo->storeRole($request);

        return redirect()->route('role.index')
            ->with('status_success', 'Role Saved successfully');
    }

    public function show(Role $role): View
    {
        return view('role.view', compact('role'));
    }

    public function edit(Role $role): View
    {

        return view('role.edit', compact('role'));
    }

    public function update(RoleUpdateRequest $request, Role $role): RedirectResponse
    {
        $this->rolesRepo->updateRole($request, $role);

        return redirect()->route('role.index')
            ->with('status_success', 'Role update successfully');
    }
}
