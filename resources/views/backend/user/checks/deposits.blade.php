@extends('backend.user.index')

@section('content')
<div class="container mx-auto max-w-4xl mt-8">
    <h2 class="text-2xl font-bold mb-4">Deposits</h2>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection