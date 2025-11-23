@extends('backend.admin.index')

@section('content')
<div class="container mx-auto max-w-lg">
    <h2 class="text-2xl font-bold mb-6">Add New User</h2>

    <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        @csrf
        <h2 class="text-2xl font-bold mb-6 text-center">Upload Users Excel</h2>

        <label for="file" class="block text-lg font-medium text-gray-700">Select Excel File:</label>
        <input type="file" name="file" id="file" class="mt-2 w-full" accept=".xlsx,.xls" required>

        <button type="submit" class="mt-6 w-full py-2 px-4 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700">
            Upload
        </button>
    </form>


    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Name</label>
            <input type="text" name="Name" required class="w-full p-2 border rounded" placeholder="Full Name">
        </div>

        <!-- Password -->
         <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Password</label>
            <input type="password" name="password" class="w-full p-2 border rounded" required>
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>


        <!-- Phone Number -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Phone Number</label>
            <input type="text" name="phone_number" class="w-full p-2 border rounded" required placeholder="e.g., (123) 456-7890">
        </div>

        <!-- City -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">City</label>
            <input type="text" name="city" required class="w-full p-2 border rounded" placeholder="city name">
        </div>

        <!-- Role -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Role</label>
            <select name="role" required class="w-full p-2 border rounded">
                <option value="employee">Employee</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_suspended" value="1" 
                    class="form-checkbox" {{ old('is_suspended', $user->is_suspended ?? false) ? 'checked' : '' }}>
                <span class="ml-2">Suspend Account</span>
            </label>
        </div>


        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Create User
        </button>
    </form>
</div>
@endsection
