@extends('backend.admin.index')

@section('content')
<div class="container mx-auto max-w-lg">
    <h2 class="text-2xl font-bold mb-6">Add New Deposit</h2>

    <form action="{{ route('admin.deposits.store') }}" method="POST">
        @csrf

        <!-- Amount -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Amount ($)</label>
            <input type="number" name="amount" min="0" step="0.01" required
                   class="w-full p-2 border rounded" placeholder="Enter deposit amount">
        </div>

        <!-- Date -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Deposit Date</label>
            <input type="date" name="deposit_date" value="{{ date('Y-m-d') }}" 
                   class="w-full p-2 border rounded" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Add Deposit
        </button>
    </form>
</div>
@endsection