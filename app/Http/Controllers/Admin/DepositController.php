<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::latest()->get();
        return view('backend.admin.deposits.index', compact('deposits'));
    }

    public function create()
    {
        return view('backend.admin.deposits.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1'
        ]);

        Deposit::create([
            'amount' => $request->amount
        ]);

        return redirect()->route('admin.deposits.index')->with('success', 'Deposit added.');
    }
}
