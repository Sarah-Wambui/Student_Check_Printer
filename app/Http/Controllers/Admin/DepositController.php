<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use Illuminate\Http\Request;
use App\Models\User;

class DepositController extends Controller
{
    public function index()
    {
        $deposits = Deposit::all();
        return view('backend.admin.deposits.index', compact('deposits'));
    }

    public function create()
    {
        // Fetch all users where role is NOT 'admin'
        $users = User::where('role', '!=', 'admin')->get();
        return view('backend.admin.deposits.create', compact('users'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'Total'   => 'required|numeric',
            'Date'    => 'required|date',
            'AM_In'   => 'nullable|date_format:H:i',
            'AM_Out'  => 'nullable|date_format:H:i',
            'PM_In'   => 'nullable|date_format:H:i',
            'PM_Out'  => 'nullable|date_format:H:i',
        ]);


        // Fetch the user from the database
        $user = User::find($request->user_id);

        Deposit::create([
            'user_id' => $request->user_id,
            'Name' => $user->Name,
            'Date' => $request->Date,
            'AM_In' => $request->AM_In,
            'AM_Out' => $request->AM_Out,
            'PM_In' => $request->PM_In,
            'PM_Out' => $request->PM_Out,
            'Total' => $request->Total,
        ]);


        return redirect()->route('admin.deposits')->with('success', 'Deposit added.');
    }

    public function destroy($id)
    {
        $deposit = Deposit::findOrFail($id);
        $deposit->delete();

        return redirect()->route('admin.deposits')->with('success', 'Deposit deleted.');
    }

}
