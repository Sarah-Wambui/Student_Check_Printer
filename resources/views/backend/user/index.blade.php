<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Check Printing</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
     @vite('resources/css/app.css')
    <style>
    .select2-container .select2-selection--single {
        height: 42px !important;
        padding: 6px 12px !important;
        border-radius: 0.375rem !important;
        border: 1px solid #d1d5db !important; /* Tailwind gray-300 */
    }
    </style>

</head>
<body>
    <div class="dashboard-page">
        <div class="min-h-screen flex bg-background transition-all duration-300" id="dashboard-wrapper">

            <!-- Sidebar -->
            <aside class="w-64 bg-white shadow-md min-h-screen transition-all duration-300" id="sidebar">
                @include('backend.partials.sidebar')
            </aside>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col transition-all duration-300" id="main-content">
                
                <!-- Topbar -->
                <header class="bg-white shadow-md w-full transition-all duration-300" id="topbar">
                    @include('backend.partials.topbar')
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
        $(document).ready(function () {

             $("#companySelect").select2({
                placeholder: "Choose Company",
                width: '100%',
                allowClear: false,
                sorter: function(data) {
                    return data; // prevents Select2 from reordering items
                }
            });

            // Detect when user selects the "Create New Company" option
            $('#companySelect').on('select2:select', function (e) {
                if (e.params.data.id === "__create_new__") {
                    window.location.href = "{{ route('user.companies.create') }}";
                }
            });
        });

    </script>
</body>
</html>