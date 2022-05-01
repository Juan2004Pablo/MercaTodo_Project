<?php

namespace App\Http\Controllers;

use App\Exports\RolesExport;

class ExportRoleController extends Controller
{
    public function export()
    {
        $this->authorize('roles.export');

        return new RolesExport();
    }
}
