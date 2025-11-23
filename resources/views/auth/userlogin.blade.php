<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Check Printing</title>
    @vite('resources/css/app.css')
    <style>
        label{
            color: #226E72;
            margin-bottom: 0.5rem;
            font-weight: 500;
            display: block;
        }
        input {
            border: 1px solid #E7A94B;
            border-radius: 8px;
            padding: 0.625rem 1rem;
            font-size: 16px;
            background: #fff;
            transition: border-color 0.12s ease, box-shadow 0.12s ease;
            outline: none;
        }  
        button {
            background-color: #E7A94B;
            color: #fff;
            border: none;
        }      
    </style>

</head>
<body class="bg-gray-100">
    <form method="POST" action="{{ route('employee.login.submit') }}" class="max-w-lg mx-auto mt-20 p-6 bg-white rounded-lg shadow-md">
        @csrf
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
        
         <!-- Phone Number -->
        <label for="phone_cell" class="block text-lg font-medium text-gray-700">Phone Number:</label>
        <input type="text" name="phone_cell" id="phone_cell" class="mt-1 w-full focus:outline-none focus:ring-1 focus:ring-indigo-500 rounded-md" required>


        <!-- Password -->
        <label for="password" class="mt-4 block text-lg font-medium text-gray-700">Password:</label>
        <input type="password" name="password" id="password" class="mt-1 w-full focus:outline-none focus-visible:ring-0 focus-visible:ring-offset-0" required >


        <!-- Submit button -->
        <button  type="submit"  class="mt-6 w-full py-2 px-4 text-lg  text-white font-medium rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Login
        </button>
    </form>
</body>

</html>