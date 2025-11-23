@extends('backend.admin.index')

@section('content')
<div class="container mx-auto max-w-lg">
    <h2 class="text-2xl font-bold mb-6">Add New User</h2>

    <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        @csrf
        <h2 class="text-2xl font-bold mb-6 text-center">Upload Users Excel</h2>

        <label for="file" class="block text-lg font-medium text-gray-700">Select Excel File:</label>
        <input type="file" name="file" id="file" class="mt-2 w-full" accept=".xlsx,.xls" required>

        <button type="submit" class="mt-6 w-full py-2 px-4 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700">
            Upload
        </button>
    </form>


    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <!-- Basic Info -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Employee ID</label>
            <input type="text" name="employee_id" class="w-full p-2 border rounded" placeholder="Employee ID">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Username</label>
            <input type="text" name="username" class="w-full p-2 border rounded" placeholder="Username">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Time Clock Name</label>
            <input type="text" name="time_clock_name" class="w-full p-2 border rounded" placeholder="Full Name">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Legal First Name</label>
            <input type="text" name="legal_first_name" class="w-full p-2 border rounded" placeholder="First Name">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Legal Last Name</label>
            <input type="text" name="legal_last_name" class="w-full p-2 border rounded" placeholder="Last Name">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Hebrew/Yiddish Name</label>
            <input type="text" name="hebrew_yiddish_name" class="w-full p-2 border rounded" placeholder="Hebrew/Yiddish Name">
        </div>

        <!-- Contact Info -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Email</label>
            <input type="email" name="email" class="w-full p-2 border rounded" placeholder="Email Address">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Password</label>
            <input type="password" name="password" class="w-full p-2 border rounded" required>
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Phone Home</label>
            <input type="text" name="phone_home" class="w-full p-2 border rounded" placeholder="Home Phone">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Phone Cell</label>
            <input type="text" name="phone_cell" class="w-full p-2 border rounded" placeholder="Cell Phone">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">City</label>
            <input type="text" name="city" class="w-full p-2 border rounded" placeholder="City">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">State</label>
            <input type="text" name="state" class="w-full p-2 border rounded" placeholder="State">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Zip</label>
            <input type="text" name="zip" class="w-full p-2 border rounded" placeholder="Zip Code">
        </div>

        <!-- Date of Birth -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Date of Birth</label>
            <input type="date" name="dob" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">SSN</label>
            <input type="text" name="ssn" class="w-full p-2 border rounded" placeholder="SSN">
        </div>

        <!-- Education -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">High School</label>
            <input type="text" name="high_school" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">HS City/State</label>
            <input type="text" name="hs_city_state" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">HS Graduation Date</label>
            <input type="date" name="hs_grad_date" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Diploma Attached?</label>
            <input type="text" name="diploma_attached" class="w-full p-2 border rounded">
        </div>

        <!-- Previous Yeshivas -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Previous BM 1 Name</label>
            <input type="text" name="prev_bm1_name" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Previous BM 1 City/State</label>
            <input type="text" name="prev_bm1_city_state" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Previous BM 1 Dates</label>
            <input type="text" name="prev_bm1_dates" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Previous BM 1 Transcript</label>
            <input type="text" name="prev_bm1_transcript" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Previous BM 2 Name</label>
            <input type="text" name="prev_bm2_name" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Previous BM 2 City/State</label>
            <input type="text" name="prev_bm2_city_state" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Previous BM 2 Dates</label>
            <input type="text" name="prev_bm2_dates" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Previous BM 2 Transcript</label>
            <input type="text" name="prev_bm2_transcript" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Other Yeshivas</label>
            <input type="text" name="other_yeshivas" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Date Enrolled Amidei</label>
            <input type="date" name="date_enrolled_amidei" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Level Admitted</label>
            <input type="text" name="level_admitted" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Father's Name</label>
            <input type="text" name="fathers_name" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Father-in-law Name</label>
            <input type="text" name="father_in_law_name" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">F-I-L Address</label>
            <input type="text" name="fil_address" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">F-I-L Phone</label>
            <input type="text" name="fil_phone" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Chabira Farmitug</label>
            <input type="text" name="chabira_farmitug" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Chabira Nuchmitug</label>
            <input type="text" name="chabira_nuchmitug" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Location/Kollel</label>
            <input type="text" name="location_kollel" class="w-full p-2 border rounded">
        </div>

        <div class="mb-4">
            <label class="block font-medium text-gray-700">Notes</label>
            <textarea name="notes" class="w-full p-2 border rounded" rows="3"></textarea>
        </div>

        <!-- Role & Suspend -->
        <div class="mb-4">
            <label class="block font-medium text-gray-700">Role</label>
            <select name="role" required class="w-full p-2 border rounded">
                <option value="employee">Employee</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_suspended" value="1" 
                    class="form-checkbox" {{ old('is_suspended', $user->is_suspended ?? false) ? 'checked' : '' }}>
                <span class="ml-2">Suspend Account</span>
            </label>
        </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Create User
    </button>
</form>

</div>
@endsection
