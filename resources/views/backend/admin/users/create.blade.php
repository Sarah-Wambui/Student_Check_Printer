@extends('backend.admin.index')

@section('content')
<div class="container mx-auto max-w-lg">
    <h2 class="text-2xl font-bold mb-6">Add New User</h2>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Name</label>
            <input type="text" name="name" required class="w-full p-2 border rounded" placeholder="Full Name">
        </div>

        <!-- Username -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Username</label>
            <input type="text" name="username" required class="w-full p-2 border rounded" placeholder="Username">
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Email</label>
            <input type="email" name="email" class="w-full p-2 border rounded" placeholder="Email Address">
        </div>

        <!-- Password -->
         <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Password</label>
            <input type="password" name="password" class="w-full p-2 border rounded" required>
        </div>


        <!-- Phone Number -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Phone Number</label>
            <input type="text" name="phone_number" class="w-full p-2 border rounded" placeholder="Optional">
        </div>

        <!-- Role -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Role</label>
            <select name="role" required class="w-full p-2 border rounded">
                <option value="employee">Employee</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <!-- Allowance Total -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Allowance Total ($)</label>
            <input type="number" name="allowance_total" min="0" step="0.01" required class="w-full p-2 border rounded" placeholder="0.00">
        </div>

        <!-- Allowance Remaining -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Allowance Remaining ($)</label>
            <input type="number" name="allowance_remaining" min="0" step="0.01" required class="w-full p-2 border rounded" placeholder="0.00">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Create User
        </button>
    </form>
</div>
@endsection
