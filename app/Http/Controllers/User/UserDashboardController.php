<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Check;
use App\Models\Company;
use App\Models\Deposit;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    // Dashboard
    public function index()
    {
        $user = Auth::user();
        $stats = [
            'total_checks' => Check::where('user_id', $user->id)->count(),
            'total_amount' => Check::where('user_id', $user->id)->sum('amount'),
            'pending_checks' => Check::where('user_id', $user->id)->where('status', 'pending')->count(),
        ];
        return view('backend.user.dashboard', compact('stats'));
    }

    // Print Check Form
    public function createCheck()
    {
        $companies = Company::all(); // Companies user can choose
        $allowance = Auth::user()->allowance_remaining;
        return view('backend.user.checks.create', compact('companies', 'allowance'));
    }

    // Store Printed Check
    public function storeCheck(Request $request)
    {
        // Validate input
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'amount' => 'required|numeric|min:50',
        ]);

        $user = Auth::user();

        // Ensure user has enough allowance
        if ($request->amount > $user->allowance_remaining) {
            return back()->withErrors(['amount' => 'Amount exceeds remaining allowance']);
        }

        // Generate a check number
        $checkNumber = 'CK' . time();

        // Create the check
        $check = \App\Models\Check::create([
            'user_id' => $user->id,
            'company_id' => $request->company_id,
            'check_number' => $checkNumber,
            'amount' => $request->amount,
            'status' => 'printed',
            'printed_at' => now(),
        ]);

        // Deduct allowance
        $user->allowance_remaining -= $request->amount;
        $user->save();

        // Redirect directly to the print view
        return redirect()->route('user.checks.print', $check->id);
    }


    // Check History
    public function history()
    {
        $checks = Check::where('user_id', Auth::id())->latest()->get();
        return view('backend.user.checks.history', compact('checks'));
    }

    // companys
    public function companies()
    {
        $companies = Company::all();
        return view('backend.user.checks.companies', compact('companies'));
    }

    // Deposits (Read-only)
    public function deposits()
    {
        $deposits = Deposit::all(); // Assuming a Deposit model
        return view('backend.user.checks.deposits', compact('deposits'));
    }
}
