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
        <div class="min-h-screen flex bg-background">

            <!-- Sidebar -->
            <aside class="w-64 bg-white shadow-md min-h-screen">
                @include('backend.partials.sidebar')
            </aside>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col">
                
                <!-- Topbar -->
                <header class="bg-white shadow-md w-full">
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
</body>
</html>