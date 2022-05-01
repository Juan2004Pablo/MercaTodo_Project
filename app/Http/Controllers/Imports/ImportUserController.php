<?php

namespace App\Http\Controllers\Imports;

use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use Illuminate\Http\Request;

class ImportUserController extends Controller
{
    public function import(Request $request)
    {
        $this->authorize('users.import');

        $file = $request->file('file');
        $import = new UsersImport();

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

    public function RoleAssigment(array $name, array $roleId)
    {
        $user = DB::table('users')->where('name', $name)->first();

        $user->roles()->sync($roleId);
    }
}
