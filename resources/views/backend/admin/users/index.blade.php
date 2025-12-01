@extends('backend.admin.index')

@section('content')

{{-- Add User Button --}}
<h1 class="text-3xl font-bold mb-6">Users</h1>

<a href="{{ route('admin.users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">
    Add User
</a>

{{-- Search Bar --}}
<form method="GET" action="{{ route('admin.users.index') }}" id="filterForm" class="mb-4">

    {{-- SEARCH --}}
    <input 
        type="text" 
        name="search" 
        id="userSearch"
        value="{{ request('search') }}" 
        placeholder="Search by name..."
        style="
            width: 700px;
            padding: 0.5rem 0.75rem;
            border-radius: 0.375rem;
            border: 2px solid #e7a94b;
            outline: none;
        "
    >

    {{-- CITY FILTER --}}
    <select 
        name="city"
        id="cityFilter"
        style="
            width: 700px;
            padding: 0.5rem 0.75rem;
            border-radius: 0.375rem;
            border: 2px solid #e7a94b;
            outline: none;
        "
    >
        <option value="">All Cities</option>

        @foreach($cities as $city)
            <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>
                {{ $city }}
            </option>
        @endforeach
    </select>

</form>



<!-- Horizontal Scroll -->
<div class="overflow-x-auto">
    <table class="min-w-max w-full bg-white shadow rounded">
        <thead class="bg-gray-200 whitespace-nowrap">
            <tr>
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Employee ID</th>
                <th class="p-2 border">Name</th>
                <th class="p-2 border">Phone Cell</th>
                <th class="p-2 border">City</th>
                <th class="p-2 border">Remaining Deposit</th>
                <th class="p-2 border">Actions</th>

                <!-- All other fields -->
                <th class="p-2 border">Username</th>
                <th class="p-2 border">Legal First Name</th>
                <th class="p-2 border">Legal Last Name</th>
                <th class="p-2 border">Hebrew/Yiddish Name</th>
                <th class="p-2 border">Email</th>
                <th class="p-2 border">Password</th>
                <th class="p-2 border">Role</th>
                <th class="p-2 border">Suspended</th>
                <th class="p-2 border">Address</th>
                <th class="p-2 border">State</th>
                <th class="p-2 border">ZIP</th>
                <th class="p-2 border">Phone Home</th>
                <th class="p-2 border">DOB</th>
                <th class="p-2 border">SSN</th>
                <th class="p-2 border">LEU Percent</th>
                <th class="p-2 border">Status 2025/26</th>
                <th class="p-2 border">High School</th>
                <th class="p-2 border">HS City/State</th>
                <th class="p-2 border">HS Grad Date</th>
                <th class="p-2 border">Diploma Attached</th>
                <th class="p-2 border">Prev BM1 Name</th>
                <th class="p-2 border">Prev BM1 City/State</th>
                <th class="p-2 border">Prev BM1 Dates</th>
                <th class="p-2 border">Prev BM1 Transcript</th>
                <th class="p-2 border">Prev BM2 Name</th>
                <th class="p-2 border">Prev BM2 City/State</th>
                <th class="p-2 border">Prev BM2 Dates</th>
                <th class="p-2 border">Prev BM2 Transcript</th>
                <th class="p-2 border">Other Yeshivas</th>
                <th class="p-2 border">Date Enrolled Amidei</th>
                <th class="p-2 border">Level Admitted</th>
                <th class="p-2 border">Father's Name</th>
                <th class="p-2 border">Father-in-law Name</th>
                <th class="p-2 border">FIL Address</th>
                <th class="p-2 border">FIL Phone</th>
                <th class="p-2 border">Chabira Farmitug</th>
                <th class="p-2 border">Chabira Nuchmitug</th>
                <th class="p-2 border">Location Kollel</th>
                <th class="p-2 border">Notes</th>
            </tr>
        </thead>

        <!-- <tbody class="whitespace-nowrap" id="usersTableBody">
            @foreach($users as $user)
                <tr class="hover:bg-gray-100">
                    <td class="p-2 border text-center">{{ $user->employee_id }}</td>
                    <td class="p-2 border text-center">{{ $user->time_clock_name }}</td>
                    <td class="p-2 border text-center">{{ $user->phone_cell }}</td>
                    <td class="p-2 border text-center">{{ $user->city }}</td>
                    <td class="p-2 border text-center">${{ number_format($user->remaining_deposit) }}</td>

                   
                    <td class="p-2 border flex space-x-4 justify-center">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-blue-500 text-white p-2 rounded hover:bg-yellow-600" title="Edit">✏️</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white p-2 rounded hover:bg-red-600" title="Delete">🗑️</button>
                        </form>
                    </td>

                
                    <td class="p-2 border">{{ $user->username }}</td>
                    <td class="p-2 border">{{ $user->legal_first_name }}</td>
                    <td class="p-2 border">{{ $user->legal_last_name }}</td>
                    <td class="p-2 border">{{ $user->hebrew_yiddish_name }}</td>
                    <td class="p-2 border">{{ $user->email }}</td>
                    <td class="p-2 border">••••••••</td>
                    <td class="p-2 border">{{ ucfirst($user->role) }}</td>
                    <td class="p-2 border text-center">{{ $user->is_suspended ? 'Yes' : 'No' }}</td>
                    <td class="p-2 border">{{ $user->address }}</td>
                    <td class="p-2 border">{{ $user->state }}</td>
                    <td class="p-2 border">{{ $user->zip }}</td>
                    <td class="p-2 border">{{ $user->phone_home }}</td>
                    <td class="p-2 border">{{ $user->dob }}</td>
                    <td class="p-2 border">{{ $user->ssn }}</td>
                    <td class="p-2 border">{{ $user->leu_percent }}</td>
                    <td class="p-2 border">{{ $user->status_2025_26 }}</td>
                    <td class="p-2 border">{{ $user->high_school }}</td>
                    <td class="p-2 border">{{ $user->hs_city_state }}</td>
                    <td class="p-2 border">{{ $user->hs_grad_date }}</td>
                    <td class="p-2 border">{{ $user->diploma_attached }}</td>
                    <td class="p-2 border">{{ $user->prev_bm1_name }}</td>
                    <td class="p-2 border">{{ $user->prev_bm1_city_state }}</td>
                    <td class="p-2 border">{{ $user->prev_bm1_dates }}</td>
                    <td class="p-2 border">{{ $user->prev_bm1_transcript }}</td>
                    <td class="p-2 border">{{ $user->prev_bm2_name }}</td>
                    <td class="p-2 border">{{ $user->prev_bm2_city_state }}</td>
                    <td class="p-2 border">{{ $user->prev_bm2_dates }}</td>
                    <td class="p-2 border">{{ $user->prev_bm2_transcript }}</td>
                    <td class="p-2 border">{{ $user->other_yeshivas }}</td>
                    <td class="p-2 border">{{ $user->date_enrolled_amidei }}</td>
                    <td class="p-2 border">{{ $user->level_admitted }}</td>
                    <td class="p-2 border">{{ $user->fathers_name }}</td>
                    <td class="p-2 border">{{ $user->father_in_law_name }}</td>
                    <td class="p-2 border">{{ $user->fil_address }}</td>
                    <td class="p-2 border">{{ $user->fil_phone }}</td>
                    <td class="p-2 border">{{ $user->chabira_farmitug }}</td>
                    <td class="p-2 border">{{ $user->chabira_nuchmitug }}</td>
                    <td class="p-2 border">{{ $user->location_kollel }}</td>
                    <td class="p-2 border">{{ $user->notes }}</td>
                </tr>
            @endforeach
        </tbody> -->
        <tbody id="usersTableBody">
            @include('backend.admin.users.index_rows')
        </tbody>

    </table>
</div>
<!-- Pagination -->
<div id="paginationWrapper">
    {{ $users->appends(request()->query())->links() }}
</div>


{{-- AJAX SEARCH --}}
<script>
    let typingTimer;
    let delay = 300; // fast & smooth

    const searchInput = document.getElementById('userSearch');
    const citySelect  = document.getElementById('cityFilter');

    // AJAX fetch function
    function fetchUsers() {
        const search = searchInput.value;
        const city   = citySelect.value;

        fetch(`{{ route('admin.users.index') }}?search=${search}&city=${city}`, {
            headers: { "X-Requested-With": "XMLHttpRequest" }
        })
        .then(res => res.json())
        .then(data => {
            document.getElementById('usersTableBody').innerHTML = data.rows;
            document.getElementById('paginationWrapper').innerHTML = data.pagination;
        });
    }

    // search → AJAX (no page reload)
    searchInput.addEventListener('keyup', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(fetchUsers, delay);
    });

    // city → FULL RELOAD (correct behavior)
    citySelect.addEventListener('change', function() {
        document.getElementById('filterForm').submit();
    });
</script>

@endsection
