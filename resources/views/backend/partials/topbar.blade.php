<!-- Include Alpine.js for dropdown functionality -->
<script src="//unpkg.com/alpinejs" defer></script>

<header class="bg-white shadow-md">
  <div class="flex justify-between items-center px-6 py-4">

    <!-- Left side: Sidebar toggle -->
    <div class="flex items-center">
      <button class="p-2 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>

    <!-- Right side: Profile dropdown -->
    <div class="relative" x-data="{ open: false }">
      <button 
        @click="open = !open"
        class="flex items-center space-x-2 px-4 py-2 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500"
      >
        <span class="font-medium text-gray-700">User</span>
        <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
      </button>

      <!-- Dropdown menu -->
      <ul 
        x-show="open" 
        @click.away="open = false"
        class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-50"
        style="display: none;"
      >
        <li>
          <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
            <i class="me-1 las la-cog"></i> Profile Settings
          </a>
        </li>
        <li>
          <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
            <i class="me-1 las la-lock"></i> Change Password
          </a>
        </li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                    <i class="me-1 las la-sign-out-alt"></i> Logout
                </button>
            </form>
        </li>

      </ul>
    </div>

  </div>
</header>
