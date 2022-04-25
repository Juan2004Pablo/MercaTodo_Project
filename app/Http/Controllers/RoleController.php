<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use App\Repositories\Role\RoleRepository;
use Illuminate\Http\RedirectResponse;
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
        $this->authorize('role.index');

        $roles = $this->rolesRepo->getAllRoles();

        return view('role.index', compact('roles'));
    }

    public function create(): View
    {
        $this->authorize('role.create');

        return view('role.create');
    }

    public function store(RoleStoreRequest $request): RedirectResponse
    {
        $this->authorize('role.create');

        $this->rolesRepo->storeRole($request);

        return redirect()->route('role.index')
            ->with('status_success', 'Role Saved successfully');
    }

    public function show(Role $role): View
    {
        $this->authorize('role.show');

        return view('role.view', compact('role'));
    }

    public function edit(Role $role): View
    {
        $this->authorize('role.update');

        return view('role.edit', compact('role'));
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

        $this->rolesRepo->delete($role);

        return redirect()->route('role.index')
            ->with('status_success', 'Role successfully removed');
    }
}
