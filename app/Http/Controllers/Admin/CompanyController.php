<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('backend.admin.companies.index', compact('companies'));
    }

    public function create()
    {
        return view('backend.admin.companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:companies,name',
        ]);

        Company::create(['name' => $request->name]);

        return redirect()->route('admin.companies')->with('success', 'Company added.');
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('backend.admin.companies.edit', compact('company'));
    }

    /**
     * Update the company in the database
     */
    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:companies,name,' . $company->id,
        ]);

        $company->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.companies')->with('success', 'Company updated successfully.');
    }
    public function destroy(Company $company)
    {
        $company->delete();
        return back()->with('success', 'Company removed.');
    }
}
