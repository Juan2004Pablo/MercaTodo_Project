<?php

namespace App\Http\Controllers\Exports;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;

class ExportUserController extends Controller
{
    protected $usersRepo;

    public function __construct(UserRepository $usersRepository)
    {
        $this->usersRepo = $usersRepository;
    }

    public function export()
    {
        $this->authorize('users.export');

        return $this->usersRepo->usersExport();
    }
}
