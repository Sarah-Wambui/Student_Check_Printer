@foreach($users as $user)
    <tr class="hover:bg-gray-100">
        <td class="p-2 border text-center">{{ $user->id }}</td>
        <td class="p-2 border text-center">{{ $user->employee_id }}</td>
        <td class="p-2 border text-center">{{ $user->time_clock_name }}</td>
        <td class="p-2 border text-center">{{ $user->phone_cell }}</td>
        <td class="p-2 border text-center">{{ $user->city }}</td>
        <td class="p-2 border text-center">${{ number_format($user->remaining_deposit) }}</td>

        <td class="p-2 border flex space-x-4 justify-center">
            <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-blue-500 text-white p-2 rounded">✏️</a>
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white p-2 rounded">🗑️</button>
            </form>
        </td>

        {{-- your remaining 40+ fields --}}
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
