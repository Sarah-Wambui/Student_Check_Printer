@extends('backend.admin.index')

@section('content')
<h1 class="text-3xl font-bold mb-6">Check History</h1>

<table class="w-full bg-white shadow rounded">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2 border">User</th>
            <th class="p-2 border">Company</th>
            <th class="p-2 border">Amount</th>
            <th class="p-2 border">Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($checks as $check)
            <tr>
                <td class="p-2 border">{{ $check->user->name }}</td>
                <td class="p-2 border">{{ $check->company->name }}</td>
                <td class="p-2 border">${{ number_format($check->amount,2) }}</td>
                <td class="p-2 border">{{ $check->created_at->format('Y-m-d') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection