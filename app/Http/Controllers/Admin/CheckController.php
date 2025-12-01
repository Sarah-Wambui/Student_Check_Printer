<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Check;
use App\Models\Deposit;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use NumberFormatter;

class CheckController extends Controller
{
    public function index()
    {
        $checks = Check::with('company', 'user')->latest()->get();
        return view('backend.admin.checks.index', compact('checks'));
    }

    public function destroy($id)
    {
        $check = Check::findOrFail($id);

        $check->delete();

        return back()->with('success', 'Check deleted and deposit restored successfully.');
    }

    public function bulkCreate(Request $request)
    {
        $city = $request->input('city');

        $users = User::where('role', 'employee')
            ->when($city, function ($query) use ($city) {
                $query->where('city', $city);
            })
            ->paginate(20);

        $cities = User::where('role', 'employee')
            ->pluck('city')
            ->filter()
            ->unique()
            ->sort()
            ->values();

        return view('backend.admin.checks.bulk_create', compact('cities', 'users', 'city'));
    }


    public function bulkStore(Request $request)
    {
        $request->validate([
            'user_ids' => 'required|array',
        ]);

        $defaultCompanyId = Company::where('name', 'Time Clock Name')->value('id');
        
        $checkIds = [];

        foreach ($request->user_ids as $userId) {

            $user = User::find($userId);
            if (! $user) continue;

            // Calculate allowance
            $totalDeposits = Deposit::where('user_id', $userId)->sum('Total');
            $totalPrinted  = Check::where('user_id', $userId)->sum('amount');
            $remaining     = $totalDeposits - $totalPrinted;

            // If no remaining allowance, skip this user
            if ($remaining <= 0) {
                continue;
            }

            // Create the check for the **remaining amount**
            $check = Check::create([
                'user_id'        => $userId,
                'company_id'     => $defaultCompanyId,
                'amount'         => $remaining,
                'status'         => 'printed',
                'printed_at'     => now(),
                'printed_name'   => $user->time_clock_name, // <--- IMPORTANT
            ]);

            // Generate check number
            $checkNumber = 1015 + $check->id - 1;
            $check->update([
                'check_number' => str_pad($checkNumber, 7, '0', STR_PAD_LEFT)
            ]);

            $checkIds[] = $check->id;
        }

        return redirect()->route('admin.checks.bulkPrint', implode(',', $checkIds));
    }




    public function bulkPrint($ids)
    {
        $checkIds = explode(',', $ids);

        $checks = Check::whereIn('id', $checkIds)->with('user', 'company')->get();

        // Convert amounts to words for each check
        foreach ($checks as $check) {
            $check->amount_in_words = $this->convertAmountToWords($check->amount);
        }

        return view('backend.admin.checks.bulk_print', compact('checks'));
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
