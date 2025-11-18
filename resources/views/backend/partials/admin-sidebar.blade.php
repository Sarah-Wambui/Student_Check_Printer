<!-- Admin Sidebar -->
<aside class="w-64 bg-gray-900 text-gray-200 min-h-screen p-4">
    <h2 class="text-xl font-bold mb-6">Admin Panel</h2>

    <ul class="space-y-2">

        <!-- Dashboard -->
        <li>
            <a href="{{ route('admin.dashboard') }}" 
               class="block px-3 py-2 hover:bg-gray-800 rounded">
               <i class="las la-tachometer-alt mr-2"></i> Dashboard
            </a>
        </li>

        <!-- Users -->
        <li>
            <a href="{{ route('admin.users') }}" 
               class="block px-3 py-2 hover:bg-gray-800 rounded">
               <i class="las la-users mr-2"></i> Users
            </a>
        </li>

        <!-- Companies -->
        <li>
            <a href="{{ route('admin.companies') }}" 
               class="block px-3 py-2 hover:bg-gray-800 rounded">
               <i class="las la-building mr-2"></i> Companies
            </a>
        </li>

        <!-- Deposits -->
        <li>
            <a href="{{ route('admin.deposits') }}" 
               class="block px-3 py-2 hover:bg-gray-800 rounded">
               <i class="las la-wallet mr-2"></i> Deposits
            </a>
        </li>

        <!-- Check History -->
        <li>
            <a href="{{ route('admin.checks.history') }}" 
               class="block px-3 py-2 hover:bg-gray-800 rounded">
               <i class="las la-history mr-2"></i> Check History
            </a>
        </li>
    </ul>
</aside>
