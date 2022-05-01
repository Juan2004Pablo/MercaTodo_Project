<?php

namespace App\Http\Controllers\Imports;

use App\Http\Controllers\Controller;
use App\Imports\RolesImport;
use Illuminate\Http\Request;

class ImportRoleController extends Controller
{
    public function import(Request $request)
    {
        $file = $request->file('file');
        $import = new RolesImport();

        try {
            $import->import($file);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            foreach ($failures as $failure) {
                $failure->row(); // row that went wrong
                $failure->attribute(); // either heading key (if using heading row concern) or column index
                $failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
            }
        }

        return back()->with('success', 'All good!');
    }
}
