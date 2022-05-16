<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\User\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    protected $usersRepo;

    public function __construct(UserRepository $usersRepository)
    {
        $this->usersRepo = $usersRepository;
    }

    public function index(): View
    {
        $this->authorize('user.index');

        $users = $this->usersRepo->getAllUsers();

        return view('user.index', compact('users'));
    }

    public function show(User $user): View
    {
        $this->authorize('user.show');

        $roles = $this->usersRepo->roleToUser();

        return view('user.show', compact('roles', 'user'));
    }

    public function edit(User $user): View
    {
        $this->authorize('user.update');

        $roles = $this->usersRepo->roleToUser();

        return view('user.edit', compact('roles', 'user'));
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $this->authorize('user.update');

        $this->usersRepo->updateUser($request, $user);

        return redirect()->route('user.index')
            ->with('status_success', 'user update successfully');
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('user.disable');

        $this->usersRepo->delete($user);

        return redirect()->route('user.index')
            ->with('status_success', 'user successfully disabled');
    }

    public function restore(Request $request): RedirectResponse
    {
        $this->authorize('user.disable');

        $this->usersRepo->restore($request);

        return redirect()->route('user.index')
            ->with('status_success', 'user  enabled');
    }
}
