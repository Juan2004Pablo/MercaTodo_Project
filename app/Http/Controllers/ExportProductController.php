<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportProductController extends Controller
{
    public function export()
    {
        return new ProductsExport();
    }
}
