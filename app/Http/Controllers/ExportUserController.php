<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;

class ExportUserController extends Controller
{
    public function export()
    {
        return new UsersExport();
    }
}
