<?php

namespace App\Http\Controllers;

use App\Exports\CategoriesExport;

class ExportCategoryController extends Controller
{
    public function export()
    {
        return new CategoriesExport();
    }
}
