@extends('backend.admin.index')

@section('content')
<div class="container mx-auto max-w-4xl">
    <h2 class="text-2xl font-bold mb-6 text-center">Edit User</h2>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="p-6 bg-white rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- Basic Info -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Employee ID</label>
                <input type="text" name="employee_id" value="{{ old('employee_id', $user->employee_id) }}" class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Username</label>
                <input type="text" name="username" value="{{ old('username', $user->username) }}" class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Time Clock Name</label>
                <input type="text" name="time_clock_name" value="{{ old('time_clock_name', $user->time_clock_name) }}" class="w-full p-2 border rounded bg-gray-100" readonly>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Legal First Name</label>
                <input type="text" name="legal_first_name" value="{{ old('legal_first_name', $user->legal_first_name) }}" class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Legal Last Name</label>
                <input type="text" name="legal_last_name" value="{{ old('legal_last_name', $user->legal_last_name) }}" class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Hebrew/Yiddish Name</label>
                <input type="text" name="hebrew_yiddish_name" value="{{ old('hebrew_yiddish_name', $user->hebrew_yiddish_name) }}" class="w-full p-2 border rounded">
            </div>

            <!-- Contact Info -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Password</label>
                <input type="password" name="password" class="w-full p-2 border rounded">
                <p class="text-sm text-gray-500 mt-1 col-span-full">Leave blank to keep current password</p>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Phone Home</label>
                <input type="text" name="phone_home" value="{{ old('phone_home', $user->phone_home) }}" class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Phone Cell</label>
                <input type="text" name="phone_cell" value="{{ old('phone_cell', $user->phone_cell) }}" class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">City</label>
                <input type="text" name="city" value="{{ old('city', $user->city) }}" class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">State</label>
                <input type="text" name="state" value="{{ old('state', $user->state) }}" class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Zip</label>
                <input type="text" name="zip" value="{{ old('zip', $user->zip) }}" class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Date of Birth</label>
                <input type="date" name="dob" value="{{ old('dob', $user->dob) }}" class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">SSN</label>
                <input type="text" name="ssn" value="{{ old('ssn', $user->ssn) }}" class="w-full p-2 border rounded">
            </div>

            <!-- Education -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">High School</label>
                <input type="text" name="high_school" value="{{ old('high_school', $user->high_school) }}" class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">HS City/State</label>
                <input type="text" name="hs_city_state" value="{{ old('hs_city_state', $user->hs_city_state) }}" class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">HS Graduation Date</label>
                <input type="date" name="hs_grad_date" value="{{ old('hs_grad_date', $user->hs_grad_date) }}" class="w-full p-2 border rounded">
            </div>

            <!-- Previous Yeshivas -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Previous BM 1 Name</label>
                <input type="text" name="prev_bm1_name" value="{{ old('prev_bm1_name', $user->prev_bm1_name) }}" class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Previous BM 1 City/State</label>
                <input type="text" name="prev_bm1_city_state" value="{{ old('prev_bm1_city_state', $user->prev_bm1_city_state) }}" class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Previous BM 1 Dates</label>
                <input type="text" name="prev_bm1_dates" value="{{ old('prev_bm1_dates', $user->prev_bm1_dates) }}" class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Previous BM 1 Transcript</label>
                <input type="text" name="prev_bm1_transcript" value="{{ old('prev_bm1_transcript', $user->prev_bm1_transcript) }}" class="w-full p-2 border rounded">
            </div>

            <!-- Add remaining BM2, Other Yeshivas, Family, and Notes in the same 2-column pattern -->

            <div class="col-span-full">
                <label class="block text-gray-700 font-medium mb-1">Notes</label>
                <textarea name="notes" class="w-full p-2 border rounded" rows="3">{{ old('notes', $user->notes) }}</textarea>
            </div>

            <!-- Role & Suspend -->
            <div>
                <label class="block font-medium text-gray-700">Role</label>
                <select name="role" class="w-full p-2 border rounded bg-gray-100" disabled>
                    <option value="employee" {{ $user->role === 'employee' ? 'selected' : '' }}>Employee</option>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>

            <div class="flex items-center mt-2">
                 <label class="inline-flex items-center">
                    <input type="checkbox" name="is_suspended" value="1" 
                        class="form-checkbox" {{ old('is_suspended', $user->is_suspended ?? false) ? 'checked' : '' }}>
                    <span class="ml-2">Suspend Account</span>
                </label>
            </div>

        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">Update User</button>
        </div>
    </form>
</div>
@endsection
