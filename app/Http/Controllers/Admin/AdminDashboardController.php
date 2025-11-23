<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\Check;
use App\Models\User;
use App\Models\Company;

class AdminDashboardController extends Controller
{
    public function index()
{
    return view('backend.admin.dashboard', [
        'totalDeposits' => Deposit::sum('Total'),
        'totalChecks' => Check::count(),
        'totalAmountPrinted' => Check::sum('amount'),
        'systemBalance' => Deposit::sum('Total') - Check::sum('amount'),
        'totalEmployees' => User::where('role', 'employee')->count(),
        'totalCompanies' => Company::count(),
        'recentChecks' => Check::latest()->take(5)->get(),
        'recentDeposits' => Deposit::latest()->take(5)->get(),
    ]);
}

}
