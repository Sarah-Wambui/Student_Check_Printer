@extends('backend.admin.index')

@section('content')
<div class="container mx-auto max-w-4xl">
    <h2 class="text-2xl font-bold mb-4">Print New Checks </h2>

    <!-- Filter Form -->
    <form method="GET" id="filterForm" action="{{ route('admin.checks.bulkCreate') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
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
            </div>
        </div>
    </form>


    <form method="POST" action="{{ route('admin.checks.bulkStore') }}">
        @csrf
        <!-- Users Table -->
        <table class="w-full bg-white shadow rounded">
            <thead>
                <tr>
                    <th class="p-2 border"><input type="checkbox" id="select-all"></th>
                    <th class="p-2 border">Name</th>
                    <th class="p-2 border">City</th>
                    <th class="p-2 border">Total Deposits</th>
                    <th class="p-2 border">Total Printed</th>
                    <th class="p-2 border">Remaining</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    @php
                        $deposits = \App\Models\Deposit::where('user_id', $user->id)->sum('Total');
                        $printed = \App\Models\Check::where('user_id', $user->id)->sum('amount');
                        $remaining = $deposits - $printed;
                    @endphp

                    <tr>
                        <td class="p-2 border text-center">
                            @if ($remaining >= 50)
                                <input type="checkbox" name="user_ids[]" value="{{ $user->id }}">
                            @else
                                <span class="text-danger">N/A</span>
                            @endif
                        </td>

                        <td class="p-2 border text-center">{{ $user->time_clock_name }}</td>
                        <td class="p-2 border text-center">{{ $user->city }}</td>
                        <td class="p-2 border text-center">${{ number_format($deposits, 2) }}</td>
                        <td class="p-2 border text-center">${{ number_format($printed, 2) }}</td>
                        <td class="p-2 border text-center">${{ number_format($remaining, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Print Checks for Selected Users</button>
    </form>
</div>

<!-- Pagination -->
<div id="paginationWrapper">
    {{ $users->appends(request()->query())->links() }}
</div>

<script>
    document.getElementById('select-all').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('input[name="user_ids[]"]');
        checkboxes.forEach(ch => ch.checked = this.checked);
    });

    const citySelect = document.getElementById('cityFilter');

    citySelect.addEventListener('change', function () {
        document.getElementById('filterForm').submit();
    });
</script>

@endsection
