@extends('backend.admin.index')

@section('content')
<h1 class="text-3xl font-bold mb-6">Check History</h1>

<table class="w-full bg-white shadow rounded">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2 border">User</th>
            <th class="p-2 border">Company</th>
            <th class="p-2 border">Check Number</th>
            <th class="p-2 border">Amount</th>
            <th class="p-2 border">Date</th>
            <th class="p-2 border">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($checks as $check)
            <tr>
                <td class="p-2 border text-center">{{ $check->user->time_clock_name }}</td>
                <td class="p-2 border text-center">{{ $check->company->name }}</td>
                <td class="p-2 border text-center">{{ $check->check_number }}</td>
                <td class="p-2 border text-center">${{ number_format($check->amount,2) }}</td>
                <td class="p-2 border text-center">{{ $check->created_at->format('Y-m-d') }}</td>
                <td class="p-2 border text-center">
                    <form action="{{ route('admin.checks.destroy', $check->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this check? This will also restore the amount to the user\'s balance.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
                    </form>
                </td>    
            </tr>
        @endforeach
    </tbody>
</table>
@endsection