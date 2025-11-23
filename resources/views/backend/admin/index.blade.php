<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Check Printing</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="dashboard-page">
        <div class="min-h-screen flex bg-background transition-all duration-300" id="dashboard-wrapper">

            <!-- Sidebar -->
            <aside class="w-64 bg-white shadow-md min-h-screen transition-all duration-300" id="sidebar">
                @include('backend.partials.admin-sidebar')
            </aside>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col transition-all duration-300" id="main-content">
                
                <!-- Topbar -->
                <header class="bg-white shadow-md w-full transition-all duration-300" id="topbar">
                    @include('backend.partials.admin-topbar')
                </header>

                <!-- Page Content -->
                <main class="flex-1 p-6 overflow-y-auto">
                    <div class="container mx-auto">
                        @yield('content')
                    </div>
                </main>

            </div>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('sidebar-toggle');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');

            toggleBtn.addEventListener('click', () => {
                if (sidebar.classList.contains('-ml-64')) {
                    // Show sidebar
                    sidebar.classList.remove('-ml-64');
                    mainContent.classList.remove('ml-0');
                } else {
                    // Hide sidebar
                    sidebar.classList.add('-ml-64'); // shift sidebar to the left
                    mainContent.classList.add('ml-0'); // expand main content
                }
            });
        });
    </script>


</body>
</html>