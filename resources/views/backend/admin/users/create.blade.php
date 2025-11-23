@extends('backend.admin.index')

@section('content')
<div class="container max-w-4xl mx-auto">

    <!-- Excel Upload Form (Centered) -->
    <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        @csrf
        <h2 class="text-2xl font-bold mb-6 text-center">Upload Users Excel</h2>

        <label for="file" class="block text-lg font-medium text-gray-700">Select Excel File:</label>
        <input type="file" name="file" id="file" class="mt-2 w-full" accept=".xlsx,.xls" required>

        <button type="submit" class="mt-6 w-full py-2 px-4 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700">
            Upload
        </button>
    </form>

    <!-- Manual User Creation Form -->
    <form action="{{ route('admin.users.store') }}" method="POST" class="mt-10 p-6 bg-white rounded-lg shadow-md">
        @csrf

        <h2 class="text-2xl font-bold mb-6 text-center">Add New User</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- Basic Info -->
            <div>
                <label class="block font-medium text-gray-700">Employee ID</label>
                <input type="text" name="employee_id" class="w-full p-2 border rounded" placeholder="Employee ID">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Username</label>
                <input type="text" name="username" class="w-full p-2 border rounded" placeholder="Username">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Time Clock Name</label>
                <input type="text" name="time_clock_name" class="w-full p-2 border rounded" placeholder="Full Name">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Legal First Name</label>
                <input type="text" name="legal_first_name" class="w-full p-2 border rounded" placeholder="First Name">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Legal Last Name</label>
                <input type="text" name="legal_last_name" class="w-full p-2 border rounded" placeholder="Last Name">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Hebrew/Yiddish Name</label>
                <input type="text" name="hebrew_yiddish_name" class="w-full p-2 border rounded" placeholder="Hebrew/Yiddish Name">
            </div>

            <!-- Contact Info -->
            <div>
                <label class="block font-medium text-gray-700">Email</label>
                <input type="email" name="email" class="w-full p-2 border rounded" placeholder="Email Address">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Password</label>
                <input type="password" name="password" class="w-full p-2 border rounded" required>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Phone Home</label>
                <input type="text" name="phone_home" class="w-full p-2 border rounded" placeholder="Home Phone">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Phone Cell</label>
                <input type="text" name="phone_cell" class="w-full p-2 border rounded" placeholder="Cell Phone">
            </div>

            <div>
                <label class="block font-medium text-gray-700">City</label>
                <input type="text" name="city" class="w-full p-2 border rounded" placeholder="City">
            </div>

            <div>
                <label class="block font-medium text-gray-700">State</label>
                <input type="text" name="state" class="w-full p-2 border rounded" placeholder="State">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Zip</label>
                <input type="text" name="zip" class="w-full p-2 border rounded" placeholder="Zip Code">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Date of Birth</label>
                <input type="date" name="dob" class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block font-medium text-gray-700">SSN</label>
                <input type="text" name="ssn" class="w-full p-2 border rounded" placeholder="SSN">
            </div>

            <!-- High School -->
            <div>
                <label class="block font-medium text-gray-700">High School</label>
                <input type="text" name="high_school" class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block font-medium text-gray-700">HS City/State</label>
                <input type="text" name="hs_city_state" class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block font-medium text-gray-700">HS Graduation Date</label>
                <input type="date" name="hs_grad_date" class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Diploma Attached?</label>
                <input type="text" name="diploma_attached" class="w-full p-2 border rounded">
            </div>

            <!-- Previous BM -->
            <div>
                <label class="block font-medium text-gray-700">Previous BM 1 Name</label>
                <input type="text" name="prev_bm1_name" class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Previous BM 1 City/State</label>
                <input type="text" name="prev_bm1_city_state" class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Previous BM 1 Dates</label>
                <input type="text" name="prev_bm1_dates" class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Previous BM 1 Transcript</label>
                <input type="text" name="prev_bm1_transcript" class="w-full p-2 border rounded">
            </div>

            <!-- More fields... continue in the same grid pattern -->

            <!-- Notes (Full Width) -->
            <div class="col-span-full">
                <label class="block font-medium text-gray-700">Notes</label>
                <textarea name="notes" class="w-full p-2 border rounded" rows="3"></textarea>
            </div>

            <!-- Role & Suspend -->
            <div>
                <label class="block font-medium text-gray-700">Role</label>
                <select name="role" required class="w-full p-2 border rounded">
                    <option value="employee">Employee</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="flex items-center mt-6">
                <input type="checkbox" name="is_suspended" value="1" class="form-checkbox mr-2">
                <label class="font-medium text-gray-700">Suspend Account</label>
            </div>

        </div>

        <button type="submit" class="mt-6 w-full py-2 px-4 bg-blue-500 text-white font-medium rounded hover:bg-blue-600">
            Create User
        </button>
    </form>
</div>
@endsection
