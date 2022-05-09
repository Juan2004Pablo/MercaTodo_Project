<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenerateReportRequest;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UsersReportController extends Controller
{
    public function index(): View
    {
        $initialDate = Carbon::now()->format('Y-m-d');
        return view('report.users.index', compact('initialDate'));
    }

    public function generate(GenerateReportRequest $request)
    {
        $users = User::whereDate('created_at', '>=', $request->get('initial-date'))
            ->whereDate('created_at', '<=', $request->get('end-date'))->orderBy('created_at', 'Asc')
            ->get(['id', 'name', 'surname', 'identification', 'address', 'phone', 'email', 'created_at']);

        $i = 0;
        $roles[] = null;
        foreach ($users as $user) {
            $roleOfModel = DB::table('model_has_roles')->where('model_id', $user->id)->first();
            $role = Role::where('id', $roleOfModel->role_id)->first();
            $roles[$i] = $role->name;
            $i++;
        }

        $pdf = PDF::loadView('report.users.usersReport', compact('users', 'roles'));
        return $pdf->stream();

        //return $pdf->download('productsReport.pdf');
    }
}
