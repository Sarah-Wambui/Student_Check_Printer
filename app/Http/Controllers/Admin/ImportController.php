<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
        public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new UsersImport, $request->file('file'));

        return redirect()->route('admin.users')->with('success', 'Users imported successfully.');
    }
}
