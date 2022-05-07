<?php

namespace App\Http\Controllers\Imports;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportFileRequest;
use App\Imports\ProductsImport;

class ImportProductController extends Controller
{
    public function import(ImportFileRequest $request)
    {
        $file = $request->file('file');
        $import = new ProductsImport();

        try {
            $import->import($file);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            foreach ($failures as $failure) {
                $failure->row(); // row that went wrong
                $failure->attribute(); // either heading key (if using heading row concern) or column index
                $failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
                dd($failure);
            }
        }

        return back()->with('success', 'All good!');
    }
}
