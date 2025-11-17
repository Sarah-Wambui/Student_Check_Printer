@extends('backend.user.index')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-white p-4 rounded shadow">
        <p class="text-gray-500">Total Checks Printed</p>
        <h2 class="text-2xl font-bold">124</h2>
    </div>
    <div class="bg-white p-4 rounded shadow">
        <p class="text-gray-500">Total Amount Printed</p>
        <h2 class="text-2xl font-bold">$12,450</h2>
    </div>
    <div class="bg-white p-4 rounded shadow">
        <p class="text-gray-500">Pending Checks</p>
        <h2 class="text-2xl font-bold">3</h2>
    </div>
</div>
@endsection