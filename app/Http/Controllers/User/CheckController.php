<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Check;

class CheckController extends Controller
{
    public function printCheck(Check $check)
    {
        // Logic to show a printable view of the check
        return view('backend.user.checks.print', compact('check'));
    }

    public function exportPdf(Check $check)
    {
        // Example using barryvdh/laravel-dompdf
        $pdf = \PDF::loadView('backend.user.checks.pdf', compact('check'));
        return $pdf->download('check-'.$check->check_number.'.pdf');
    }

}
