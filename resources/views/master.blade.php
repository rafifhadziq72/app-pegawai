<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'App Pegawai')</title>
    @vite(['resources/css/app.css'])
    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Alpine.js for sidebar toggle -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-50 dark:bg-gray-900" x-data="{ sidebarOpen: true }">

    <!-- Sidebar -->
    <aside 
        :class="{ 'w-64': sidebarOpen, 'w-16': !sidebarOpen }"
        class="fixed top-0 left-0 z-40 h-screen transition-all duration-300 ease-in-out bg-gray-800 dark:bg-gray-800"
        aria-label="Sidebar"
    >
        <div class="h-full px-3 py-4 overflow-y-auto">
            <!-- Header with Logo Icon Only -->
            <div class="flex items-center justify-between mb-5">
                <!-- Yellow Square: Large App Icon -->
                <a href="{{ url('/') }}" class="flex items-center pl-2.5">
                    <i class="bi bi-person-workspace text-white text-2xl" x-show="sidebarOpen"></i>
                    <i class="bi bi-person-workspace text-white text-xl" x-show="!sidebarOpen"></i>
                    <span x-show="sidebarOpen" class="self-center text-xl font-semibold ms-3 whitespace-nowrap text-white">App Pegawai</span>
                </a>
                <!-- Red Square: Toggle Button BELOW Settings -->
                <!-- We'll place this later in the list -->
            </div>
            
            <!-- Navigation Links -->
            <ul class="space-y-2 font-medium">
                <li class="group relative">
                    <a href="{{ url('/employees') }}" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700">
                        <i class="bi bi-people-fill text-gray-400 group-hover:text-white w-5 h-5"></i>
                        <span x-show="sidebarOpen" class="ms-3">Employee</span>
                        <span x-show="!sidebarOpen && tooltipVisible" class="absolute left-16 top-0.5 bg-gray-900 text-white text-xs py-1 px-2 rounded shadow-lg z-50 whitespace-nowrap">
                            Employee
                        </span>
                    </a>
                </li>
                <li class="group relative">
                    <a href="{{ url('/departments') }}" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700">
                        <i class="bi bi-building text-gray-400 group-hover:text-white w-5 h-5"></i>
                        <span x-show="sidebarOpen" class="ms-3">Department</span>
                        <span x-show="!sidebarOpen && tooltipVisible" class="absolute left-16 top-0.5 bg-gray-900 text-white text-xs py-1 px-2 rounded shadow-lg z-50 whitespace-nowrap">
                            Department
                        </span>
                    </a>
                </li>
                <li class="group relative">
                    <a href="{{ url('/attendances') }}" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700">
                        <i class="bi bi-journal-check text-gray-400 group-hover:text-white w-5 h-5"></i>
                        <span x-show="sidebarOpen" class="ms-3">Attendance</span>
                        <span x-show="!sidebarOpen && tooltipVisible" class="absolute left-16 top-0.5 bg-gray-900 text-white text-xs py-1 px-2 rounded shadow-lg z-50 whitespace-nowrap">
                            Attendance
                        </span>
                    </a>
                </li>
                <li class="group relative">
                    <a href="{{ url('/positions') }}" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700">
                        <i class="bi bi-postcard-fill text-gray-400 group-hover:text-white w-5 h-5"></i>
                        <span x-show="sidebarOpen" class="ms-3">Position</span>
                        <span x-show="!sidebarOpen && tooltipVisible" class="absolute left-16 top-0.5 bg-gray-900 text-white text-xs py-1 px-2 rounded shadow-lg z-50 whitespace-nowrap">
                            Position
                        </span>
                    </a>
                </li>
                <li class="group relative">
                    <a href="{{ url('/salaries') }}" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700">
                        <i class="bi bi-currency-dollar text-gray-400 group-hover:text-white w-5 h-5"></i>
                        <span x-show="sidebarOpen" class="ms-3">Salary</span>
                        <span x-show="!sidebarOpen && tooltipVisible" class="absolute left-16 top-0.5 bg-gray-900 text-white text-xs py-1 px-2 rounded shadow-lg z-50 whitespace-nowrap">
                            Salary
                        </span>
                    </a>
                </li>
                <li class="group relative">
                    <a href="{{ url('/report') }}" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700">
                        <i class="bi bi-file-earmark-text-fill text-gray-400 group-hover:text-white w-5 h-5"></i>
                        <span x-show="sidebarOpen" class="ms-3">Report</span>
                        <span x-show="!sidebarOpen && tooltipVisible" class="absolute left-16 top-0.5 bg-gray-900 text-white text-xs py-1 px-2 rounded shadow-lg z-50 whitespace-nowrap">
                            Report
                        </span>
                    </a>
                </li>
                <li class="group relative">
                    <a href="{{ url('/settings') }}" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700">
                        <i class="bi bi-sliders text-gray-400 group-hover:text-white w-5 h-5"></i>
                        <span x-show="sidebarOpen" class="ms-3">Settings</span>
                        <span x-show="!sidebarOpen && tooltipVisible" class="absolute left-16 top-0.5 bg-gray-900 text-white text-xs py-1 px-2 rounded shadow-lg z-50 whitespace-nowrap">
                            Settings
                        </span>
                    </a>
                </li>
                <!-- Red Square: Toggle Button Below Settings -->
                <li class="group relative">
                    <button 
                        @click="sidebarOpen = !sidebarOpen"
                        class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 w-full"
                    >
                        <i class="bi" :class="sidebarOpen ? 'bi-chevron-left' : 'bi-chevron-right'" style="font-size: 1.2rem;"></i>
                        <span x-show="sidebarOpen" class="ms-3">Collapse</span>
                    </button>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main Content -->
    <div 
        :class="{ 'sm:ml-64': sidebarOpen, 'sm:ml-16': !sidebarOpen }"
        class="p-4 transition-all duration-300 ease-in-out"
    >
        <!-- Navbar -->
        <nav class="mb-4 flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
            <h1 class="text-xl font-bold text-gray-900 dark:text-white">@yield('page-title', 'App Pegawai')</h1>
            <!-- Optional: Add logout or profile here -->
        </nav>

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="mt-8 pt-4 border-t border-gray-200 dark:border-gray-700">
            <p class="text-sm text-gray-500 dark:text-gray-400">&copy; {{ date('Y') }} App Pegawai</p>
        </footer>
    </div>

    <!-- Tooltip Visibility Control -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('sidebar', () => ({
                sidebarOpen: true,
                tooltipVisible: false,
                init() {
                    if (!this.sidebarOpen) {
                        this.$el.addEventListener('mouseenter', () => {
                            this.tooltipVisible = true;
                        });
                        this.$el.addEventListener('mouseleave', () => {
                            this.tooltipVisible = false;
                        });
                    }
                }
            }));
        });
    </script>

</body>
</html>