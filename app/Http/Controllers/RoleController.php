<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Repositories\Role\RoleRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    protected $rolesRepo;

    public function __construct(RoleRepository $rolesRepository)
    {
        $this->rolesRepo = $rolesRepository;
    }

    public function index(): View
    {
        $this->authorize('role.index');

        $roles = $this->rolesRepo->getAllRoles();

        return view('role.index', compact('roles'));
    }

    public function create(): View
    {
        $this->authorize('role.create');

        $permissions = $this->rolesRepo->permissionCreate();

        return view('role.create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $this->authorize('role.create');

        $this->rolesRepo->storeRole($request);

        return redirect()->route('role.index')
            ->with('status_success', 'Role Created successfully');
    }

    public function show(Role $role): View
    {
        $this->authorize('role.show');

        $roleHasPermissions = $this->rolesRepo->rolePermissions($role);

        $permissions = $this->rolesRepo->permissionCreate();

        return view('role.show', compact('role', 'permissions', 'roleHasPermissions'));
    }

    public function edit(Role $role): View
    {
        $this->authorize('role.update');

        $roleHasPermissions = $this->rolesRepo->rolePermissions($role);

        $permissions = $this->rolesRepo->permissionCreate();

        return view('role.edit', compact('role', 'permissions', 'roleHasPermissions'));
    }

    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        $this->authorize('role.update');

        $this->rolesRepo->updateRole($request, $role);

        return redirect()->route('role.index')
            ->with('status_success', 'Role update successfully');
    }

    public function destroy(Role $role): RedirectResponse
    {
        $this->authorize('role.disable');

        return $this->rolesRepo->deleteRole($role);
    }
}
