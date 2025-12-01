@extends('backend.user.index')

@section('content')
<div class="container mx-auto max-w-4xl">
    <h2 class="text-2xl font-bold mb-4">Print New Check</h2>

    <!-- Display general error message -->
    @if(session('error')) 
        <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('user.checks.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Payee</label>
            <select id="companySelect" name="company_id"  class="w-full p-2 border rounded" required>
                <option>Choose Company</option> <!-- For placeholder -->
                <option value="__create_new__">+ Create New Payee</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
                
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Amount ($)</label>
            <input type="number" name="amount" min="50" step="0.01" class="w-full p-2 border rounded" placeholder="Enter amount (>= $50)" required >
            @error('amount')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Print Check
        </button>
    </form>
</div>


@endsection
