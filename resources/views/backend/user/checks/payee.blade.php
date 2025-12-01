@extends('backend.user.index')

@section('content')
<div class="container mx-auto max-w-lg">
    <h2 class="text-2xl font-bold mb-6">Add New Payee</h2>

    <form action="{{ route('user.companies.store') }}" method="POST">
        @csrf

        <!-- Company Name -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Payee Name</label>
            <input type="text" name="name" required 
                   class="w-full p-2 border rounded" placeholder="Enter payee name">
        </div>

        <button type="submit" 
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Create Payee
        </button>
    </form>
</div>
@endsection
