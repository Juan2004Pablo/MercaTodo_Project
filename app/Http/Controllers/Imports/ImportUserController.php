<?php

namespace App\Http\Controllers\Imports;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;

class ImportUserController extends Controller
{
    protected $usersRepo;

    public function __construct(UserRepository $usersRepository)
    {
        $this->usersRepo = $usersRepository;
    }

    public function import(Request $request)
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
