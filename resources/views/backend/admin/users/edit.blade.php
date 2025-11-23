@extends('backend.admin.index')

@section('content')
<div class="container mx-auto max-w-lg">
    <h2 class="text-2xl font-bold mb-6">Edit User</h2>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <!-- Name -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Name</label>
            <input type="text" name="Name" value="{{ old('Name', $user->Name) }}" class="w-full p-2 border rounded" required>
            @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <!-- Password -->
         <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Password</label>
            <input type="password" name="password" class="w-full p-2 border rounded"  required>
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full p-2 border rounded">
            @error('email')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Phone -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">Phone Number</label>
            <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="w-full p-2 border rounded" required>
            @error('phone_number')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- City -->
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-1">City</label>
            <input type="text" name="city" value="{{ old('city', $user->city) }}" class="w-full p-2 border rounded" required>
            @error('city')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <!-- Deposits -->
        <div class="mb-4">
            <div>
                <label class="block text-gray-700 font-medium mb-1">User Deposits</label>
                <input type="number" step="0.01" name="user_deposits" value="{{ $user->user_deposits }}" class="w-full p-2 border rounded">
            </div>
        </div>

        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_suspended" value="1" 
                    class="form-checkbox" {{ old('is_suspended', $user->is_suspended ?? false) ? 'checked' : '' }}>
                <span class="ml-2">Suspend Account</span>
            </label>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update User</button>
        </div>

    </form>

</div>
@endsection
