@extends('backend.admin.index')

@section('content')
<h1 class="text-3xl font-bold mb-6">Companies</h1>

<a href="{{ route('admin.companies.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">Add Company</a>

<table class="w-full bg-white shadow rounded">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2 border">Company Name</th>
            <th class="p-2 border">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($companies as $company)
            <tr>
                <td class="p-2 border">{{ $company->name }}</td>
                <td class="p-2 border flex space-x-2">
                    <!-- Edit Button (Pen SVG) -->
                    <a href="{{ route('admin.companies.edit', $company->id) }}"
                    class="bg-blue-500 text-white p-2 rounded hover:bg-yellow-600"
                    title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5h2M4 21h16a2 2 0 002-2V7a2 2 0 00-2-2H7L4 7v12a2 2 0 002 2z" />
                        </svg>
                    </a>
                    <form action="{{ route('admin.companies.destroy', $company->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-1 12a2 2 0 01-2 2H8a2 2 0 01-2-2L5 7m5 0V5a2 2 0 012-2h0a2 2 0 012 2v2m4 0H5" />
                            </svg>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection