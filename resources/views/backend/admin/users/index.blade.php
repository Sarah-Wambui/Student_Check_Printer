@extends('backend.admin.index')

@section('content')
<h1 class="text-3xl font-bold mb-6">Users</h1>

<a href="{{ route('admin.users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">Add User</a>

<table class="w-full bg-white shadow rounded">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2 border">ID</th>   
            <th class="p-2 border">Name</th>          
            <th class="p-2 border">Phone Number</th>
            <th class="p-2 border">City</th>
            <th class="p-2 border">Remaining Deposit</th>
            <th class="p-2 border">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td class="p-2 border text-center">{{ $user->employee_id}}</td>
                <td class="p-2 border text-center">{{ $user->time_clock_name }}</td>
                <td class="p-2 border text-center">{{ $user->phone_cell }}</td>
                <td class="p-2 border text-center">{{ $user->city }}</td>
                <td class="p-2 border text-center">${{ number_format($user->remaining_deposit) }}</td>
                <td class="p-2 border flex space-x-4 justify-center">
                    <!-- Edit Button (Pen SVG) -->
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-blue-500 text-white p-2 rounded hover:bg-yellow-600" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 21h8m.174-14.188a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/></svg>
                    </a>

                    <!-- Delete Button (Trash SVG) -->
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-red-600" title="Delete">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7h16m-10 4v6m4-6v6M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12M9 7V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3"/></svg>
                        </button>
                    </form>
                </td>

            </tr>
        @endforeach
    </tbody>
</table>

@endsection