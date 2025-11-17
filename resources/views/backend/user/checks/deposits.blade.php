@extends('backend.user.index')

@section('content')
<div class="container mx-auto max-w-4xl mt-8">
    <h2 class="text-2xl font-bold mb-4">Deposits</h2>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">ID</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Date</th>
                    <th class="py-3 px-4 text-left font-semibold text-gray-600">Amount ($)</th>
                </tr>
            </thead>

            <tbody>
                @forelse($deposits as $deposit)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-4">{{ $deposit->id }}</td>
                        <td class="py-2 px-4">{{ $deposit->created_at->format('Y-m-d') }}</td>
                        <td class="py-2 px-4 font-semibold">
                            ${{ number_format($deposit->amount, 2) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-4 text-center text-gray-500">
                            No deposits found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection