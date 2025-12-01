<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function create()
    {
        return view('backend.user.checks.payee');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:companies,name',
        ]);

        Company::create(['name' => $request->name]);

        return redirect()->route('user.checks.create')->with('success', 'Company added.');
    }

}
