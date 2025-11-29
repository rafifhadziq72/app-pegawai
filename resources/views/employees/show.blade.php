<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pegawai</title>
    @vite(['resources/css/app.css'])
    <!-- Jika kamu menggunakan FlowBite JS/CSS via NPM, uncomment baris di bawah -->
    <!-- @vite(['resources/js/app.js']) -->
    <!-- <link rel="stylesheet" href="path/to/flowbite.min.css" /> -->
</head>

<body class="bg-gray-50 dark:bg-gray-900">
    @extends('master')
    @section('content')
        <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
            <div class="mx-auto max-w-4xl px-4 lg:px-12">
                <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                    <!-- Header -->
                    <div
                        class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 border-b border-gray-200 dark:border-gray-700">
                        <div class="w-full">
                            <h1 class="text-xl font-bold text-gray-900 dark:text-white">Detail Pegawai</h1>
                        </div>
                    </div>

                    <!-- Detail Content -->
                    <div class="p-6">
                        <dl
                            class="grid max-w-screen-lg mx-auto text-gray-900 divide-y divide-gray-200 dark:divide-gray-700 dark:text-white sm:grid-cols-3 sm:gap-4">
                                                       <div class="flex flex-col pb-3 sm:gap-1 sm:col-span-1">
                                <dt class="text-gray-500 dark:text-gray-400">Nama Lengkap</dt>
                            </div>
                            <div class="flex flex-col pb-3 sm:gap-1 sm:col-span-2">
                                <dd class="font-medium dark:text-white">
                                    {{ $employee->nama_lengkap }}
                                </dd>
                            </div>

                            <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-1">
                                <dt class="text-gray-500 dark:text-gray-400">Email</dt>
                            </div>
                            <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-2">
                                <dd class="font-medium dark:text-white">
                                    {{ $employee->email }}
                                </dd>
                            </div>

                            <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-1">
                                <dt class="text-gray-500 dark:text-gray-400">Nomor Telepon</dt>
                            </div>
                            <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-2">
                                <dd class="font-medium dark:text-white">
                                    {{ $employee->nomor_telepon }}
                                </dd>
                            </div>

                            <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-1">
                                <dt class="text-gray-500 dark:text-gray-400">Tanggal Lahir</dt>
                            </div>
                            <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-2">
                                <dd class="font-medium dark:text-white">
                                    {{ $employee->tanggal_lahir }}
                                </dd>
                            </div>

                            <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-1">
                                <dt class="text-gray-500 dark:text-gray-400">Alamat</dt>
                            </div>
                            <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-2">
                                <dd class="font-medium dark:text-white">
                                    {{ $employee->alamat }}
                                </dd>
                            </div>

                            <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-1">
                                <dt class="text-gray-500 dark:text-gray-400">Tanggal Masuk</dt>
                            </div>
                            <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-2">
                                <dd class="font-medium dark:text-white">
                                    {{ $employee->tanggal_masuk }}
                                </dd>
                            </div>

                            <!-- NEW: Position -->
                            <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-1">
                                <dt class="text-gray-500 dark:text-gray-400">Jabatan</dt>
                            </div>
                            <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-2">
                                <dd class="font-medium dark:text-white">
                                    {{ $employee->position ? $employee->position->nama_jabatan : '-' }}
                                </dd>
                            </div>
                            <!-- END NEW: Position -->

                            <!-- NEW: Department (if you also want to show department) -->
                            <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-1">
                                <dt class="text-gray-500 dark:text-gray-400">Departemen</dt>
                            </div>
                            <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-2">
                                <dd class="font-medium dark:text-white">
                                    {{ $employee->department ? $employee->department->nama_departemen : '-' }}
                                </dd>
                            </div>
                            <!-- END NEW: Department -->

                            <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-1">
                                <dt class="text-gray-500 dark:text-gray-400">Status</dt>
                            </div>
                            <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-2">
                                <dd class="font-medium dark:text-white">
                                    <span
                                        class="bg-{{ $employee->status == 'aktif' ? 'green' : 'red' }}-100 text-{{ $employee->status == 'aktif' ? 'green' : 'red' }}-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-{{ $employee->status == 'aktif' ? 'green' : 'red' }}-900 dark:text-{{ $employee->status == 'aktif' ? 'green' : 'red' }}-200">
                                        {{ ucfirst($employee->status) }}
                                    </span>
                                </dd>
                            </div>
                        </dl>

                        <!-- NEW: Salary Section -->
                        <div class="mt-8">
                            <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Riwayat Gaji</h2>
                            <a href="{{ route('salaries.index', ['employee_id' => $employee->id]) }}"
                                class="inline-block px-4 py-2 text-sm font-medium text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                Lihat Semua Gaji
                            </a>
                            <!-- Optionally, display the latest salary record directly here -->
                            @if($employee->salaries->first()) <!-- Assuming 'salaries' relationship is defined -->
                                <div class="mt-4 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Gaji Terakhir
                                        ({{ $employee->salaries->first()->bulan }}):</p>
                                    <p class="font-medium dark:text-white">Rp
                                        {{ number_format($employee->salaries->first()->total_gaji, 2, ',', '.') }}</p>
                                </div>
                            @else
                                <p class="mt-4 text-gray-500 dark:text-gray-400">Belum ada data gaji untuk karyawan ini.</p>
                            @endif
                        </div>
                        <!-- END NEW: Salary Section -->

                        <!-- Buttons -->
                        <div class="flex space-x-4 mt-6">
                            <a href="{{ route('employees.edit', $employee->id) }}"
                                class="px-5 py-2.5 text-sm font-medium text-center text-white bg-yellow-500 rounded-lg hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                                Edit
                            </a>
                            <a href="{{ route('employees.index') }}"
                                class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                                Kembali
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    @endsection
</body>

</html>