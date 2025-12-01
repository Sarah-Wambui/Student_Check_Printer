<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Show the profile form
    public function edit()
    {
        $user = Auth::user();
        return view('backend.user.profile', compact('user'));
    }

    // Update the profile
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'employee_id'         => 'nullable|string|max:255',
            'username'            => 'nullable|string|max:255',
            'legal_first_name'    => 'nullable|string|max:255',
            'legal_last_name'     => 'nullable|string|max:255',
            'hebrew_yiddish_name' => 'nullable|string|max:255',
            'email'               => 'nullable|email|max:255|unique:users,email,' . $user->id,
            'password'            => 'nullable|min:8|confirmed',
            'phone_home'          => 'nullable|string|max:20',
            'phone_cell'          => 'nullable|string|max:20',
            'city'                => 'nullable|string|max:255',
            'state'               => 'nullable|string|max:255',
            'zip'                 => 'nullable|string|max:20',
            'dob'                 => 'nullable|date',
            'ssn'                 => 'nullable|string|max:20',
            'high_school'         => 'nullable|string|max:255',
            'hs_city_state'       => 'nullable|string|max:255',
            'hs_grad_date'        => 'nullable|date',
            'prev_bm1_name'       => 'nullable|string|max:255',
            'prev_bm1_city_state' => 'nullable|string|max:255',
            'prev_bm1_dates'      => 'nullable|string|max:255',
            'prev_bm1_transcript' => 'nullable|string|max:255',
            'prev_bm2_name'       => 'nullable|string|max:255',
            'prev_bm2_city_state' => 'nullable|string|max:255',
            'prev_bm2_dates'      => 'nullable|string|max:255',
            'prev_bm2_transcript' => 'nullable|string|max:255',
            'other_yeshivas'      => 'nullable|string|max:255',
            'fathers_name'        => 'nullable|string|max:255',
            'father_in_law_name'  => 'nullable|string|max:255',
            'fil_address'         => 'nullable|string|max:255',
            'fil_phone'           => 'nullable|string|max:20',
            'chabira_farmitug'    => 'nullable|string|max:255',
            'chabira_nuchmitug'   => 'nullable|string|max:255',
            'location_kollel'     => 'nullable|string|max:255',
            'notes'               => 'nullable|string',
        ]);

        // Update fields
        $user->fill($request->except([
            'time_clock_name',
            'role',
            'is_suspended',
            'username',
            'employee_id',
            'status_2025_26',
            'leu_percent',
            'password',
        ]));


        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
}