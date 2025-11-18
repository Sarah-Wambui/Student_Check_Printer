<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'employee')->get();
        return view('backend.admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('backend.admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'allowance_total' => 'required|numeric|min:0',
            'allowance_remaining' => 'required|numeric|min:0',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password, // mutator will hash
            'phone_number' => $request->phone_number,
            'role' => $request->role,
            'allowance_total' => $request->allowance_total,
            'allowance_remaining' => $request->allowance_remaining,
        ]);


        return redirect()->route('admin.users')->with('success', 'User created.');
    }

     // Show edit form
    public function edit($id)
    {
        $user = User::findOrFail($id); // Get the user or fail
        return view('backend.admin.users.edit', compact('user'));
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:20',
            'role' => 'required|in:admin,employee',
            'allowance_total' => 'required|numeric|min:0',
            'allowance_remaining' => 'required|numeric|min:0',
            'password' => 'nullable|string|min:6|confirmed', // Optional password field
        ]);

        // Update user fields
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->role = $request->role;
        $user->allowance_total = $request->allowance_total;
        $user->allowance_remaining = $request->allowance_remaining;

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

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
