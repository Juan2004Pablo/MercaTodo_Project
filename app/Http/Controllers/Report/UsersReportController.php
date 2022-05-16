<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenerateReportRequest;
use App\Repositories\User\UserRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\View\View;

class UsersReportController extends Controller
{
    protected $usersRepo;

    public function __construct(UserRepository $usersRepository)
    {
        $this->usersRepo = $usersRepository;
    }

    public function index(): View
    {
        $this->authorize('usersReport.generate');

        $initialDate = Carbon::now()->format('Y-m-d');
        return view('report.users.index', compact('initialDate'));
    }

    public function generate(GenerateReportRequest $request): Response
    {
        $users = $this->usersRepo->usersSearch($request);

        $roles = $this->usersRepo->rolesSearch($users);

        $pdf = PDF::loadView('report.users.usersReport', compact('users', 'roles'));
        return $pdf->stream();

        //return $pdf->download('productsReport.pdf');
    }
}
