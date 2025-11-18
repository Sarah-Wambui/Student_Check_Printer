@extends('backend.admin.index')

@section('content')
<div class="container mx-auto max-w-lg">
    <h2 class="text-2xl font-bold mb-6">Edit User</h2>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Name</label>
            <input type="text" name="name" required class="w-full p-2 border rounded" value="{{ $user->name }}">
        </div>

        <!-- Username -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Username</label>
            <input type="text" name="username" required class="w-full p-2 border rounded" value="{{ $user->username }}">
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Email</label>
            <input type="email" name="email" class="w-full p-2 border rounded" value="{{ $user->email }}">
        </div>

        <!-- Phone Number -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Phone Number</label>
            <input type="text" name="phone_number" class="w-full p-2 border rounded" value="{{ $user->phone_number }}">
        </div>

        <!-- Role -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Role</label>
            <select name="role" required class="w-full p-2 border rounded">
                <option value="employee" {{ $user->role === 'employee' ? 'selected' : '' }}>Employee</option>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <!-- Allowance Total -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Allowance Total ($)</label>
            <input type="number" name="allowance_total" min="0" step="0.01" required class="w-full p-2 border rounded" value="{{ $user->allowance_total }}">
        </div>

        <!-- Allowance Remaining -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Allowance Remaining ($)</label>
            <input type="number" name="allowance_remaining" min="0" step="0.01" required class="w-full p-2 border rounded" value="{{ $user->allowance_remaining }}">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
            Update User
        </button>
    </form>
</div>
@endsection
