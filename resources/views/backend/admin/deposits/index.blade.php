@extends('backend.admin.index')

@section('content')
<h1 class="text-3xl font-bold mb-6">Deposits</h1>

<a href="{{ route('admin.deposits.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">Add Deposit</a>

<table class="w-full bg-white shadow rounded">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2 border">Name</th>
            <th class="p-2 border">Date</th>
            <th class="p-2 border">AM In</th>
            <th class="p-2 border">AM Out</th>
            <th class="p-2 border">PM In</th>
            <th class="p-2 border">PM Out</th>
            <th class="p-2 border">Total</th>
            <th class="p-2 border">Actions</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach($deposits as $deposit)
            <tr>
                <td class="p-2 border text-center">{{ $deposit->user->Name }}</td>
                <td class="p-2 border text-center">{{ \Carbon\Carbon::parse($deposit->Date)->format('m/d/Y') }}</td>
                <td class="p-2 border text-center">{{ $deposit->AM_In ? \Carbon\Carbon::createFromFormat('H:i:s', $deposit->AM_In)->format('h:i A') : '' }}</td>
                <td class="p-2 border text-center">{{ $deposit->AM_Out ? \Carbon\Carbon::createFromFormat('H:i:s', $deposit->AM_Out)->format('h:i A') : '' }}</td>
                <td class="p-2 border text-center">{{ $deposit->PM_In ? \Carbon\Carbon::createFromFormat('H:i:s', $deposit->PM_In)->format('h:i A') : '' }}</td>
                <td class="p-2 border text-center">{{ $deposit->PM_Out ? \Carbon\Carbon::createFromFormat('H:i:s', $deposit->PM_Out)->format('h:i A') : '' }}</td>
                <td class="p-2 border text-center">${{ number_format($deposit->Total,2) }}</td>
                <td class="p-2 border text-center">
                    <form action="{{ route('admin.deposits.destroy', $deposit->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this deposit?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection