@extends('backend.user.index')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 px-8">
    
    <!-- Total Checks Printed -->
    <div class="bg-white p-4 rounded shadow">
        <p class="text-gray-500">Total Checks Printed</p>
        <h2 class="text-2xl font-bold">{{ $stats['total_checks'] }}</h2>
    </div>

    <!-- Total Amount Printed -->
    <div class="bg-white p-4 rounded shadow">
        <p class="text-gray-500">Total Amount Printed</p>
        <h2 class="text-2xl font-bold">${{ number_format($stats['total_amount'], 2) }}</h2>
    </div>

    <!-- Remaining Deposit -->
    <div class="bg-white p-4 rounded shadow">
        <p class="text-gray-500">Remaining Deposit</p>
        <h2 class="text-2xl font-bold">${{ number_format($stats['remaining_deposit'], 2) }}</h2>
    </div>

</div>

@endsection