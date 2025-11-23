@extends('backend.user.index')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">

    @if (session('success'))
        <div class="bg-green-200 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('password.update') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700">Current Password</label>
            <input type="password" name="current_password"
                   class="w-full border p-2 rounded" required>
            @error('current_password')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">New Password</label>
            <input type="password" name="password"
                   class="w-full border p-2 rounded" required>
            @error('password')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded">
            Update Password
        </button>
    </form>
</div>
@endsection