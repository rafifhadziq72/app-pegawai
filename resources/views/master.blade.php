<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'App Pegawai')</title>
    @vite(['resources/css/app.css'])
    <!-- Tambahkan Bootstrap Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Jika kamu menggunakan FlowBite JS/CSS via NPM, uncomment baris di bawah -->
    <!-- @vite(['resources/js/app.js']) -->
    <!-- <link rel="stylesheet" href="path/to/flowbite.min.css" /> -->
</head>

<body class="bg-gray-50 dark:bg-gray-900">

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-800 dark:bg-gray-800">
            <a href="{{ url('/') }}" class="flex items-center pl-2.5 mb-5">
                <span class="self-center text-xl font-semibold whitespace-nowrap text-white">App Pegawai</span>
            </a>
            <ul class="space-y-2 font-medium">
                <li>
                    <!-- Employee -->
                    <a href="{{ url('/employees') }}" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 group">
                        <i class="bi bi-people-fill text-gray-400 group-hover:text-white w-5 h-5"></i>
                        <span class="ms-3">Employee</span>
                    </a>
                </li>
                <li>
                    <!-- Department -->
                    <a href="{{ url('/departments') }}" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 group">
                        <i class="bi bi-building text-gray-400 group-hover:text-white w-5 h-5"></i>
                        <span class="ms-3">Department</span>
                    </a>
                </li>
                <li>
                    <!-- Attendance -->
                    <a href="{{ url('/attendances') }}" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 group">
                        <i class="bi bi-journal-check text-gray-400 group-hover:text-white w-5 h-5"></i>
                        <span class="ms-3">Attendance</span>
                    </a>
                </li>
                <li>
                    <!-- Position -->
                    <a href="{{ url('/positions') }}" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 group">
                        <i class="bi bi-postcard-fill text-gray-400 group-hover:text-white w-5 h-5"></i>
                        <span class="ms-3">Position</span>
                    </a>
                </li>
                <!-- <li> -->
                    <!-- Salary -->
                    <!-- <a href="{{ url('/salaries') }}" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 group">
                        <i class="bi bi-currency-dollar text-gray-400 group-hover:text-white w-5 h-5"></i> <!- - Ikon alternatif untuk Salary -- >
                        <span class="ms-3">Salary</span>
                    </a>
                </li>
                <li> -->
                    <!-- Report -->
                    <a href="{{ url('/report') }}" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 group">
                        <i class="bi bi-file-earmark-text-fill text-gray-400 group-hover:text-white w-5 h-5"></i>
                        <span class="ms-3">Report</span>
                    </a>
                </li>
                <li>
                    <!-- Settings -->
                    <a href="{{ url('/settings') }}" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 group">
                        <i class="bi bi-sliders text-gray-400 group-hover:text-white w-5 h-5"></i>
                        <span class="ms-3">Settings</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="p-4 sm:ml-64">
        <!-- Navbar -->
        <nav class="mb-4 flex justify-between items-center p-4 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
            <h1 class="text-xl font-bold text-gray-900 dark:text-white">@yield('page-title', 'App Pegawai')</h1>
            <!-- Tambahkan elemen navbar lain di sini jika perlu, misalnya tombol logout, profil, dsb -->
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

</body>
</html>