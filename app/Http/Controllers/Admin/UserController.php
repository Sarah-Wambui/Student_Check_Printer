<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Deposit;
use App\Models\Check;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $city   = $request->input('city');

        $users = User::where('role', 'employee')
            ->when($search, function ($query) use ($search) {
                $query->where('time_clock_name', 'like', "%{$search}%")
                    ->orWhere('legal_first_name', 'like', "%{$search}%")
                    ->orWhere('legal_last_name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            })
            ->when($city, function ($query) use ($city) {
            $query->where('city', $city);
            })
            ->paginate(20);

        foreach ($users as $user) {
            $totalDeposits = Deposit::where('user_id', $user->id)->sum('Total');
            $totalPrinted  = Check::where('user_id', $user->id)->sum('amount');

            $remaining = $totalDeposits - $totalPrinted;
            if ($remaining < 0) $remaining = 0;

            $user->remaining_deposit = $remaining;
        }

        // If AJAX request → return HTML only
        if ($request->ajax()) {
            return response()->json([
                'rows'       => view('backend.admin.users.index_rows', compact('users'))->render(),
                'pagination' => $users->appends($request->query())->links()->toHtml(),
            ]);
        }

        $cities = User::where('role', 'employee')->pluck('city')->unique()->sort()->values();

        return view('backend.admin.users.index', compact('users', 'search', 'city', 'cities'));

    }


    public function create()
    {
        return view('backend.admin.users.create');
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'employee_id' => 'nullable|string',
            'username' => 'nullable|string',
            'time_clock_name' => 'nullable|string',
            'legal_first_name' => 'nullable|string',
            'legal_last_name' => 'nullable|string',
            'hebrew_yiddish_name' => 'nullable|string',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'nullable|string|min:8',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'zip' => 'nullable|string',
            'phone_home' => 'nullable|string',
            'phone_cell' => 'nullable|string',
            'dob' => 'nullable|date',
            'ssn' => 'nullable|string',
            'leu_percent' => 'nullable|string',
            'status_2025_26' => 'nullable|string',
            'high_school' => 'nullable|string',
            'hs_city_state' => 'nullable|string',
            'hs_grad_date' => 'nullable|string',
            'diploma_attached' => 'nullable|string',
            'prev_bm1_name' => 'nullable|string',
            'prev_bm1_city_state' => 'nullable|string',
            'prev_bm1_dates' => 'nullable|string',
            'prev_bm1_transcript' => 'nullable|string',
            'prev_bm2_name' => 'nullable|string',
            'prev_bm2_city_state' => 'nullable|string',
            'prev_bm2_dates' => 'nullable|string',
            'prev_bm2_transcript' => 'nullable|string',
            'other_yeshivas' => 'nullable|string',
            'date_enrolled_amidei' => 'nullable|string',
            'level_admitted' => 'nullable|string',
            'fathers_name' => 'nullable|string',
            'father_in_law_name' => 'nullable|string',
            'fil_address' => 'nullable|string',
            'fil_phone' => 'nullable|string',
            'chabira_farmitug' => 'nullable|string',
            'chabira_nuchmitug' => 'nullable|string',
            'location_kollel' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        // Create user
        User::create([
            'employee_id'          => $request->employee_id,
            'username'             => $request->username,
            'time_clock_name'      => $request->time_clock_name,
            'legal_first_name'     => $request->legal_first_name,
            'legal_last_name'      => $request->legal_last_name,
            'hebrew_yiddish_name'  => $request->hebrew_yiddish_name,
            'email'                => $request->email,
            'password' => $request->password,  // hashed via mutator
            'role' => $request->role,
            'is_suspended' => $request->has('is_suspended') ? true : false,
            'address'              => $request->address,
            'city'                 => $request->city,
            'state'                => $request->state,
            'zip'                  => $request->zip,
            'phone_home'           => $request->phone_home,
            'phone_cell'           => $request->phone_cell,
            'dob'                  => $request->dob,
            'ssn'                  => $request->ssn,
            'leu_percent'          => $request->leu_percent,
            'status_2025_26'       => $request->status_2025_26,
            'high_school'          => $request->high_school,
            'hs_city_state'        => $request->hs_city_state,
            'hs_grad_date'         => $request->hs_grad_date,
            'diploma_attached'     => $request->diploma_attached,

            'prev_bm1_name'        => $request->prev_bm1_name,
            'prev_bm1_city_state'  => $request->prev_bm1_city_state,
            'prev_bm1_dates'       => $request->prev_bm1_dates,
            'prev_bm1_transcript'  => $request->prev_bm1_transcript,

            'prev_bm2_name'        => $request->prev_bm2_name,
            'prev_bm2_city_state'  => $request->prev_bm2_city_state,
            'prev_bm2_dates'       => $request->prev_bm2_dates,
            'prev_bm2_transcript'  => $request->prev_bm2_transcript,

            'other_yeshivas'       => $request->other_yeshivas,
            'date_enrolled_amidei' => $request->date_enrolled_amidei,
            'level_admitted'       => $request->level_admitted,

            'fathers_name'         => $request->fathers_name,
            'father_in_law_name'   => $request->father_in_law_name,
            'fil_address'          => $request->fil_address,
            'fil_phone'            => $request->fil_phone,

            'chabira_farmitug'     => $request->chabira_farmitug,
            'chabira_nuchmitug'    => $request->chabira_nuchmitug,

            'location_kollel'      => $request->location_kollel,
            'notes'                => $request->notes,
        ]);


        return redirect()->route('admin.users')->with('success', 'User created successfully.');
    }
     // Show edit form
    public function edit($id)
    {
        $user = User::findOrFail($id); // Get the user or fail
        return view('backend.admin.users.edit', compact('user'));
    }

    // Update user
    public function update(Request $request, User $user)
    {
        // Validate input
        $request->validate([
            'employee_id' => 'nullable|string',
            'username' => 'nullable|string',
            'time_clock_name' => 'nullable|string',
            'legal_first_name' => 'nullable|string',
            'legal_last_name' => 'nullable|string',
            'hebrew_yiddish_name' => 'nullable|string',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'nullable|in:admin,employee',
            'is_suspended' => 'nullable|boolean',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state' => 'nullable|string',
            'zip' => 'nullable|string',
            'phone_home' => 'nullable|string',
            'phone_cell' => 'nullable|string',
            'dob' => 'nullable|date',
            'ssn' => 'nullable|string',
            'leu_percent' => 'nullable|string',
            'status_2025_26' => 'nullable|string',
            'high_school' => 'nullable|string',
            'hs_city_state' => 'nullable|string',
            'hs_grad_date' => 'nullable|string',
            'diploma_attached' => 'nullable|string',
            'prev_bm1_name' => 'nullable|string',
            'prev_bm1_city_state' => 'nullable|string',
            'prev_bm1_dates' => 'nullable|string',
            'prev_bm1_transcript' => 'nullable|string',
            'prev_bm2_name' => 'nullable|string',
            'prev_bm2_city_state' => 'nullable|string',
            'prev_bm2_dates' => 'nullable|string',
            'prev_bm2_transcript' => 'nullable|string',
            'other_yeshivas' => 'nullable|string',
            'date_enrolled_amidei' => 'nullable|string',
            'level_admitted' => 'nullable|string',
            'fathers_name' => 'nullable|string',
            'father_in_law_name' => 'nullable|string',
            'fil_address' => 'nullable|string',
            'fil_phone' => 'nullable|string',
            'chabira_farmitug' => 'nullable|string',
            'chabira_nuchmitug' => 'nullable|string',
            'location_kollel' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        // Update user
        $user->employee_id         = $request->employee_id ?? $user->employee_id;
        $user->username            = $request->username ?? $user->username;
        $user->time_clock_name     = $request->time_clock_name ?? $user->time_clock_name;
        $user->legal_first_name    = $request->legal_first_name ?? $user->legal_first_name;
        $user->legal_last_name     = $request->legal_last_name ?? $user->legal_last_name;
        $user->hebrew_yiddish_name = $request->hebrew_yiddish_name ?? $user->hebrew_yiddish_name;
        $user->address             = $request->address ?? $user->address;
        $user->email               = $request->email ?? $user->email;
        $user->city                = $request->city ?? $user->city;
        $user->state               = $request->state ?? $user->state;
        $user->zip                 = $request->zip ?? $user->zip;
        $user->phone_home          = $request->phone_home ?? $user->phone_home;
        $user->phone_cell          = $request->phone_cell ?? $user->phone_cell;
        $user->dob                 = $request->dob ?? $user->dob;
        $user->ssn                 = $request->ssn ?? $user->ssn;
        $user->leu_percent         = $request->leu_percent ?? $user->leu_percent;
        $user->status_2025_26      = $request->status_2025_26 ?? $user->status_2025_26;
        $user->high_school         = $request->high_school ?? $user->high_school;
        $user->hs_city_state       = $request->hs_city_state ?? $user->hs_city_state;
        $user->hs_grad_date        = $request->hs_grad_date ?? $user->hs_grad_date;
        $user->diploma_attached    = $request->diploma_attached ?? $user->diploma_attached;
        // Previous BM1
        $user->prev_bm1_name       = $request->prev_bm1_name ?? $user->prev_bm1_name;
        $user->prev_bm1_city_state = $request->prev_bm1_city_state ?? $user->prev_bm1_city_state;
        $user->prev_bm1_dates      = $request->prev_bm1_dates ?? $user->prev_bm1_dates;
        $user->prev_bm1_transcript = $request->prev_bm1_transcript ?? $user->prev_bm1_transcript;
        // Previous BM2
        $user->prev_bm2_name       = $request->prev_bm2_name ?? $user->prev_bm2_name;
        $user->prev_bm2_city_state = $request->prev_bm2_city_state ?? $user->prev_bm2_city_state;
        $user->prev_bm2_dates      = $request->prev_bm2_dates ?? $user->prev_bm2_dates;
        $user->prev_bm2_transcript = $request->prev_bm2_transcript ?? $user->prev_bm2_transcript;
        $user->other_yeshivas       = $request->other_yeshivas ?? $user->other_yeshivas;
        $user->date_enrolled_amidei = $request->date_enrolled_amidei ?? $user->date_enrolled_amidei;
        $user->level_admitted       = $request->level_admitted ?? $user->level_admitted;
        $user->fathers_name         = $request->fathers_name ?? $user->fathers_name;
        $user->father_in_law_name   = $request->father_in_law_name ?? $user->father_in_law_name;
        $user->fil_address          = $request->fil_address ?? $user->fil_address;
        $user->fil_phone            = $request->fil_phone ?? $user->fil_phone;
        $user->chabira_farmitug     = $request->chabira_farmitug ?? $user->chabira_farmitug;
        $user->chabira_nuchmitug    = $request->chabira_nuchmitug ?? $user->chabira_nuchmitug;
        $user->location_kollel      = $request->location_kollel ?? $user->location_kollel;
        $user->notes                = $request->notes ?? $user->notes;

        // Role
        $user->role = $request->role ?? $user->role;

        // Suspension
        $user->is_suspended = $request->has('is_suspended') ? true : false;

        //  // Only update password if provided
        // if ($request->filled('password')) {
        //     $user->password = $request->password; // Mutator will hash
        // }

        $user->save();

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->role === 'admin') {
            return back()->withErrors('Cannot delete an admin.');
        }

        $user->delete();
        return back()->with('success', 'User deleted.');
    }
}
