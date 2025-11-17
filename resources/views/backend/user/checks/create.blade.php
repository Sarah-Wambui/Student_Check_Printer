@extends('backend.user.index')

@section('content')
<div class="container mx-auto max-w-4xl">
    <h2 class="text-2xl font-bold mb-4">Print New Check</h2>

    <form action="{{ route('user.checks.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Payee (Company)</label>
            <select name="company_id" required class="w-full p-2 border rounded">
                @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Amount ($)</label>
            <input type="number" name="amount" min="50" step="0.01" required
                   class="w-full p-2 border rounded" placeholder="Enter amount (>= $50)">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Print Check
        </button>
    </form>
</div>
@endsection
