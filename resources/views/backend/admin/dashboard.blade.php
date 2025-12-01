@extends('backend.admin.index')

@section('content')

<div class="container mx-auto max-w-6xl py-6">

    <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

    {{-- STAT CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <div class="p-6 bg-white shadow rounded">
            <h3 class="text-gray-500 text-sm">Total Deposits</h3>
            <p class="text-2xl font-semibold">${{ number_format($totalDeposits, 2) }}</p>
        </div>

        <div class="p-6 bg-white shadow rounded">
            <h3 class="text-gray-500 text-sm">Total Checks Printed</h3>
            <p class="text-2xl font-semibold">{{ $totalChecks }}</p>
        </div>

        <div class="p-6 bg-white shadow rounded">
            <h3 class="text-gray-500 text-sm">Total Amount Printed</h3>
            <p class="text-2xl font-semibold">${{ number_format($totalAmountPrinted, 2) }}</p>
        </div>

        <div class="p-6 bg-white shadow rounded">
            <h3 class="text-gray-500 text-sm">System Balance</h3>
            <p class="text-2xl font-semibold 
                {{ $systemBalance < 0 ? 'text-red-600' : 'text-green-600' }}">
                ${{ number_format($systemBalance, 2) }}
            </p>
        </div>

        <div class="p-6 bg-white shadow rounded">
            <h3 class="text-gray-500 text-sm">Total Employees</h3>
            <p class="text-2xl font-semibold">{{ $totalEmployees }}</p>
        </div>

        <div class="p-6 bg-white shadow rounded">
            <h3 class="text-gray-500 text-sm">Total Companies</h3>
            <p class="text-2xl font-semibold">{{ $totalCompanies }}</p>
        </div>

    </div>

    {{-- RECENT CHECKS --}}
    <div class="bg-white shadow rounded p-6 mb-8">
        <h2 class="text-xl font-bold mb-4">Recent Checks</h2>

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-3 border">User</th>
                    <th class="p-3 border">Company</th>
                    <th class="p-3 border">Amount</th>
                    <th class="p-3 border">Date</th>
                </tr>
            </thead>

            <tbody>
                @foreach($recentChecks as $check)
                <tr>
                    <td class="p-3 border">{{ $check->user->time_clock_name ?? 'N/A' }}</td>
                    <td class="p-3 border">{{ $check->company->name ?? 'N/A' }}</td>
                    <td class="p-3 border">${{ number_format($check->amount, 2) }}</td>
                    <td class="p-3 border">{{ $check->created_at->format('Y-m-d') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- RECENT DEPOSITS --}}
    <div class="bg-white shadow rounded p-6">
        <h2 class="text-xl font-bold mb-4">Recent Deposits</h2>

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-3 border">ID</th>
                    <th class="p-3 border">Amount</th>
                    <th class="p-3 border">Date</th>
                </tr>
            </thead>

            <tbody>
                @foreach($recentDeposits as $deposit)
                <tr>
                    <td class="p-3 border">{{ $deposit->id }}</td>
                    <td class="p-3 border">${{ number_format($deposit->amount,2) }}</td>
                    <td class="p-3 border">{{ $deposit->created_at->format('Y-m-d') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>


@endsection