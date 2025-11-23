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

        // Total checks printed
        $total_checks = Check::where('user_id', $user->id)->count();

        // Total amount printed
        $total_amount_printed = Check::where('user_id', $user->id)->sum('amount');

        // Pending checks
        $pending_checks = Check::where('user_id', $user->id)
            ->where('status', 'pending')
            ->count();


        // Step 1: Get total deposits from deposits table
        $totalDeposits = Deposit::where('user_id', $user->id)->sum('Total');

        // Step 2: Get total amount of printed checks
        $totalPrinted = Check::where('user_id', $user->id)->sum('amount');

        // Step 3: Calculate remaining allowance
        $remaining_deposit = $totalDeposits - $totalPrinted;


        if ($remaining_deposit < 0) $remaining_deposit = 0;

        $stats = [
            'total_checks' => $total_checks,
            'total_amount' => $total_amount_printed,
            'pending_checks' => $pending_checks,
            'remaining_deposit' => $remaining_deposit,
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
        $user = Auth::user();

        // Check if the user account is suspended
        if ($user->is_suspended) {
            return redirect()->back()->with('error', 'Your account is suspended. Please contact the admin.');
        }

        // Validate the input
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'amount' => 'required|numeric|min:50', // ensures amount >= 50
        ]);

        // Step 1: Get total deposits from deposits table
        $totalDeposits = Deposit::where('user_id', $user->id)->sum('Total');

        // Step 2: Get total amount of printed checks
        $totalPrinted = Check::where('user_id', $user->id)->sum('amount');

        // Step 3: Calculate remaining allowance
        $remainingAllowance = $totalDeposits - $totalPrinted;

        if ($request->amount > $remainingAllowance) {
            return back()->withErrors([
                'amount' => 'Amount exceeds your remaining allowance of $' . number_format($remainingAllowance, 2)
            ])->withInput();
        }

        // Step 4: Create the check WITHOUT the check_number
        $check = Check::create([
            'user_id' => $user->id,
            'company_id' => $request->company_id,
            'amount' => $request->amount,
            'status' => 'printed',
            'printed_at' => now(),
        ]);

        // Step 5: Generate the check number starting at 1015
        $checkNumber = 1015 + $check->id - 1;

        // Step 6: Update the check with the check number
        $check->update([
            'check_number' => str_pad($checkNumber, 7, '0', STR_PAD_LEFT)
        ]);

        // Redirect to print page
        return redirect()->route('user.checks.print', $check->id)
                        ->with('success', 'Check printed successfully.');
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
        $user = Auth::user(); // current logged-in user
        $deposits = Deposit::where('user_id', $user->id)->get();
        return view('backend.user.checks.deposits', compact('deposits'));
    }
}
