<!-- Admin Sidebar -->
<aside id="sidebar" class="w-64 bg-gray-900 text-gray-200 min-h-screen p-4">
    <h2 class="text-xl font-bold mb-6">Cheque Printer</h2>

    <ul class="space-y-3">

        <!-- Dashboard -->
        <li>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 hover:bg-gray-800 rounded">
               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#fff" d="M12 4C6.486 4 2 8.486 2 14a9.9 9.9 0 0 0 1.051 4.445c.17.34.516.555.895.555h16.107c.379 0 .726-.215.896-.555A9.9 9.9 0 0 0 22 14c0-5.514-4.486-10-10-10m7.41 13H4.59A7.9 7.9 0 0 1 4 14c0-4.411 3.589-8 8-8s8 3.589 8 8a7.9 7.9 0 0 1-.59 3"/><path fill="#fff" d="M10.939 12.939a1.53 1.53 0 0 0 0 2.561a1.53 1.53 0 0 0 2.121-.44l3.962-6.038a.03.03 0 0 0 0-.035a.033.033 0 0 0-.045-.01z"/></svg>
               Dashboard
            </a>
        </li>

        <!-- Users -->
        <li>
            <a href="{{ route('admin.users') }}"  class="flex items-center gap-3 px-3 py-2 hover:bg-gray-800 rounded">
               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#fff" d="M16 17v2H2v-2s0-4 7-4s7 4 7 4m-3.5-9.5A3.5 3.5 0 1 0 9 11a3.5 3.5 0 0 0 3.5-3.5m3.44 5.5A5.32 5.32 0 0 1 18 17v2h4v-2s0-3.63-6.06-4M15 4a3.4 3.4 0 0 0-1.93.59a5 5 0 0 1 0 5.82A3.4 3.4 0 0 0 15 11a3.5 3.5 0 0 0 0-7"/></svg> 
               Users
            </a>
        </li>

        <!-- Companies -->
        <li>
            <a href="{{ route('admin.companies') }}" class="flex items-center gap-3 px-3 py-2 hover:bg-gray-800 rounded">
               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16"><path fill="#fff" d="M15 .5a.5.5 0 0 0-.724-.447l-8 4A.5.5 0 0 0 6 4.5v3.14L.342 9.526A.5.5 0 0 0 0 10v5.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V14h1v1.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5zM2 11h1v1H2zm2 0h1v1H4zm-1 2v1H2v-1zm1 0h1v1H4zm9-10v1h-1V3zM8 5h1v1H8zm1 2v1H8V7zM8 9h1v1H8zm2 0h1v1h-1zm-1 2v1H8v-1zm1 0h1v1h-1zm3-2v1h-1V9zm-1 2h1v1h-1zm-2-4h1v1h-1zm3 0v1h-1V7zm-2-2v1h-1V5zm1 0h1v1h-1z"/></svg>
               Companies
            </a>
        </li>

        <!-- Deposits -->
        <li>
            <a href="{{ route('admin.deposits') }}" class="flex items-center gap-3 px-3 py-2 hover:bg-gray-800 rounded">
               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#fff" d="M6 20q-1.65 0-2.825-1.175T2 16V8q0-1.65 1.175-2.825T6 4h12q1.65 0 2.825 1.175T22 8v8q0 1.65-1.175 2.825T18 20zM6 8h12q.55 0 1.05.125t.95.4V8q0-.825-.587-1.412T18 6H6q-.825 0-1.412.588T4 8v.525q.45-.275.95-.4T6 8m-1.85 3.25l11.125 2.7q.225.05.45 0t.425-.2l3.475-2.9q-.275-.375-.7-.612T18 10H6q-.65 0-1.137.338t-.713.912"/></svg>
               Deposits
            </a>
        </li>

        <!-- Check History -->
        <li>
            <a href="{{ route('admin.checks.history') }}" class="flex items-center gap-3 px-3 py-2 hover:bg-gray-800 rounded">
               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#fff" d="M12 21q-3.45 0-6.012-2.287T3.05 13H5.1q.35 2.6 2.313 4.3T12 19q2.925 0 4.963-2.037T19 12t-2.037-4.962T12 5q-1.725 0-3.225.8T6.25 8H9v2H3V4h2v2.35q1.275-1.6 3.113-2.475T12 3q1.875 0 3.513.713t2.85 1.924t1.925 2.85T21 12t-.712 3.513t-1.925 2.85t-2.85 1.925T12 21m2.8-4.8L11 12.4V7h2v4.6l3.2 3.2z"/></svg>
               Check History
            </a>
        </li>
    </ul>
</aside>
<div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden md:hidden z-40"></div>
