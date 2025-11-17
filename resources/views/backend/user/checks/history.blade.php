@extends('backend.user.index')

@section('content')
<div class="container mx-auto max-w-6xl">
    <h2 class="text-2xl font-bold mb-4">Printed Checks</h2>

    <table class="min-w-full bg-white border rounded">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="py-2 px-4 border">ID</th>
                <th class="py-2 px-4 border">Date</th>
                <th class="py-2 px-4 border">Check No</th>
                <th class="py-2 px-4 border">Payee</th>
                <th class="py-2 px-4 border">Amount ($)</th>
                <th class="py-2 px-4 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($checks as $check)
                <tr>
                    <td class="py-2 px-4 border">{{ $check->id }}</td>
                    <td class="py-2 px-4 border">{{ $check->created_at->format('Y-m-d') }}</td>
                    <td class="py-2 px-4 border">{{ $check->check_number}}</td>
                    <td class="py-2 px-4 border">{{ $check->company->name }}</td>
                    <td class="py-2 px-4 border">{{ number_format($check->amount,2) }}</td>
                    <td class="py-2 px-4 border flex space-x-2">
                        <a href="{{ route('user.checks.print', $check->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded">Print</a>
                        <!-- <a href="{{ route('user.checks.pdf', $check->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded">Export PDF</a> -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
