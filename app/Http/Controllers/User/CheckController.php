<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Check;
use NumberFormatter;

class CheckController extends Controller
{
    public function printCheck(Check $check)
    {
        // Create amount in words
        $check->amount_in_words = $this->convertAmountToWords($check->amount);

        return view('backend.user.checks.print', [
            'check' => $check,
            'loggedInUser' => auth()->user()
        ]);
    }

    public function exportPdf(Check $check)
    {
        // Create amount in words
        $check->amount_in_words = $this->convertAmountToWords($check->amount);

        $pdf = \PDF::loadView('backend.user.checks.pdf', [
            'check' => $check,
            'loggedInUser' => auth()->user()
        ]);

        return $pdf->download('check-'.$check->check_number.'.pdf');
    }

    private function convertAmountToWords($amount)
    {
        $formatter = new NumberFormatter('en', NumberFormatter::SPELLOUT);

        $dollars = floor($amount);
        $cents = sprintf("%02d", ($amount - $dollars) * 100);

        $dollarWords = ucfirst($formatter->format($dollars)) . " Dollars";

        if ($cents == "00") {
            return $dollarWords . " and No Cents";
        }

        return $dollarWords . " and {$cents}/100";
    }

}
