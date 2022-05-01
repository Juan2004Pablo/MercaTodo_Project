<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;

class ExportUserController extends Controller
{
    public function export()
    {
        $this->authorize('users.export');
        return new UsersExport();
    }
}
