<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;

class ExportProductController extends Controller
{
    public function export()
    {
        return new ProductsExport();
    }
}
