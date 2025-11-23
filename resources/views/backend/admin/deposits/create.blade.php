@extends('backend.admin.index')

@section('content')
<div class="container mx-auto max-w-lg">
    <h2 class="text-2xl font-bold mb-6">Add New Deposit</h2>

    <form action="{{ route('deposits.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block mb-2 font-medium">Select Excel File</label>
            <input type="file" name="file" accept=".xlsx,.csv" class="border p-2 rounded w-full">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Import
        </button>
    </form>

    <form action="{{ route('admin.deposits.store') }}" method="POST">
    @csrf

    <!-- Select User -->
    <div class="mb-4">
        <label for="user_id" class="block font-medium text-gray-700">Select User</label>
        <select id="user_id" name="user_id" class="w-full p-2 border rounded" required>
            <option value="">-- Choose User --</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">
                    {{ $user->Name }} @if($user->time_clock_name) ({{ $user->time_clock_name }}) @endif
                </option>
            @endforeach
        </select>
        @error('user_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Deposit Date -->
    <div class="mb-4">
        <label for="deposit_date" class="block font-medium text-gray-700">Deposit Date</label>
        <input 
            type="date" 
            id="deposit_date"
            name="Date" 
            value="{{ old('Date', date('Y-m-d')) }}" 
            class="w-full p-2 border rounded" 
            required>
        @error('Date')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- AM In -->
    <div class="mb-4">
        <label for="AM_In" class="block font-medium text-gray-700">AM In</label>
        <input type="time" id="AM_In" name="AM_In" value="{{ old('AM_In') }}" class="w-full p-2 border rounded">
        @error('AM_In')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- AM Out -->
    <div class="mb-4">
        <label for="AM_Out" class="block font-medium text-gray-700">AM Out</label>
        <input type="time" id="AM_Out" name="AM_Out" value="{{ old('AM_Out') }}" class="w-full p-2 border rounded">
        @error('AM_Out')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- PM In -->
    <div class="mb-4">
        <label for="PM_In" class="block font-medium text-gray-700">PM In</label>
        <input type="time" id="PM_In" name="PM_In" value="{{ old('PM_In') }}" class="w-full p-2 border rounded">
        @error('PM_In')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- PM Out -->
    <div class="mb-4">
        <label for="PM_Out" class="block font-medium text-gray-700">PM Out</label>
        <input type="time" id="PM_Out" name="PM_Out" value="{{ old('PM_Out') }}" class="w-full p-2 border rounded">
        @error('PM_Out')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Total Amount -->
    <div class="mb-4">
        <label for="Total" class="block font-medium text-gray-700">Total($)</label>
        <input type="number" id="Total" name="Total"  step="0.01" value="{{ old('Total') }}" class="w-full p-2 border rounded" required>
        @error('Total')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>


    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors">
        Add Deposit
    </button>
</form>


</div>
@endsection