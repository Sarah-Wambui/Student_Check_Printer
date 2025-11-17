@extends('backend.user.index')

@section('content')

<div class="container mx-auto max-w-6xl mt-8">
    <h2 class="text-2xl font-bold mb-4">Companies</h2>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Company Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($companies as $company)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $company->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $company->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $company->created_at->format('Y-m-d') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{ route('user.checks.create', ['company_id' => $company->id]) }}" 
                           class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                           Select
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection