@extends('backend.admin.index')

@section('content')
<h1 class="text-3xl font-bold mb-6">Deposits</h1>

<a href="{{ route('admin.deposits.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">Add Deposit</a>

<table class="w-full bg-white shadow rounded">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2 border">Amount</th>
            <th class="p-2 border">Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($deposits as $deposit)
            <tr>
                <td class="p-2 border">${{ number_format($deposit->amount,2) }}</td>
                <td class="p-2 border">{{ $deposit->created_at->format('Y-m-d') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection