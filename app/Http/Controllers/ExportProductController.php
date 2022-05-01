<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;

class ExportProductController extends Controller
{
    public function export()
    {
        $this->authorize('products.export');

        return new ProductsExport();
    }
}
