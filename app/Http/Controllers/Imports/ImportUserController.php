<?php

namespace App\Http\Controllers\Imports;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportFileRequest;
use App\Repositories\User\UserRepository;

class ImportUserController extends Controller
{
    protected $usersRepo;

    public function __construct(UserRepository $usersRepository)
    {
        $this->usersRepo = $usersRepository;
    }

    public function import(ImportFileRequest $request)
    {
        $this->authorize('users.import');
      
        $this->usersRepo->usersImport($request);

        return back()->with('success', 'All good!');
    }

    public function RoleAssignment(array $name, array $roleId): void
    {
        $user = DB::table('users')->where('name', $name)->first();

        $user->roles()->sync($roleId);
    }
}
