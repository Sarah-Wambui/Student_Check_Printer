<aside class="w-64 bg-white shadow-md min-h-screen p-4">
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-700">Check Printing</h2>
    </div>

    <ul class="space-y-3">
        <!-- Dashboard -->
        <li>
            <a href="{{ route('user.dashboard') }}" class="flex items-center p-2 text-gray-700 rounded hover:bg-gray-100">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3"/>
                </svg>
                Dashboard
            </a>
        </li>

        <!-- Print Check -->
        <li>
            <a href="{{ route('user.checks.create') }}" class="flex items-center p-2 text-gray-700 rounded hover:bg-gray-100">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8v4l3 3m6 1V7a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2h8"/>
                </svg>
                Print Check
            </a>
        </li>

        <!-- Check History -->
        <li>
            <a href="{{ route('user.checks.history') }}" class="flex items-center p-2 text-gray-700 rounded hover:bg-gray-100">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 12h18M3 6h18M3 18h18"/>
                </svg>
                Printed Check History
            </a>
        </li>

        <!-- Payable Names -->
        <li>
            <a href="{{ route('user.companies') }}" class="flex items-center p-2 text-gray-700 rounded hover:bg-gray-100">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m2 0a2 2 0 100-4H7a2 2 0 100 4h10z"/>
                </svg>
                Company Names
            </a>
        </li>

        <!-- Deposits -->
        <li>
            <a href="{{ route('user.deposits') }}" class="flex items-center p-2 text-gray-700 rounded hover:bg-gray-100">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8v4l3 3m6 1V7a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2h8"/>
                </svg>
                Deposits
            </a>
        </li>
    </ul>
</aside>
