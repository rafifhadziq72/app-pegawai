<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Gaji Karyawan</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-50 dark:bg-gray-900">
    @extends('master')
    @section('content')
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
        <div class="mx-auto max-w-4xl px-4 lg:px-12">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <!-- Header -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="w-full">
                        <h1 class="text-xl font-bold text-gray-900 dark:text-white">Detail Gaji Karyawan</h1>
                    </div>
                </div>
                <!-- Detail Content -->
                <div class="p-6">
                    <dl class="grid max-w-screen-lg mx-auto text-gray-900 divide-y divide-gray-200 dark:divide-gray-700 dark:text-white sm:grid-cols-3 sm:gap-4">
                        <div class="flex flex-col pb-3 sm:gap-1 sm:col-span-1">
                            <dt class="text-gray-500 dark:text-gray-400">Karyawan</dt>
                        </div>
                        <div class="flex flex-col pb-3 sm:gap-1 sm:col-span-2">
                            <dd class="font-medium dark:text-white">
                                {{ $salary->employee->nama_lengkap ?? 'Tidak diketahui' }}
                            </dd>
                        </div>
                        <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-1">
                            <dt class="text-gray-500 dark:text-gray-400">Bulan</dt>
                        </div>
                        <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-2">
                            <dd class="font-medium dark:text-white">
                                {{ $salary->bulan }}
                            </dd>
                        </div>
                        <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-1">
                            <dt class="text-gray-500 dark:text-gray-400">Gaji Pokok</dt>
                        </div>
                        <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-2">
                            <dd class="font-medium dark:text-white">
                                Rp {{ number_format($salary->gaji_pokok, 2, ',', '.') }}
                            </dd>
                        </div>
                        <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-1">
                            <dt class="text-gray-500 dark:text-gray-400">Tunjangan</dt>
                        </div>
                        <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-2">
                            <dd class="font-medium dark:text-white">
                                Rp {{ number_format($salary->tunjangan, 2, ',', '.') }}
                            </dd>
                        </div>
                        <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-1">
                            <dt class="text-gray-500 dark:text-gray-400">Potongan</dt>
                        </div>
                        <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-2">
                            <dd class="font-medium dark:text-white">
                                Rp {{ number_format($salary->potongan, 2, ',', '.') }}
                            </dd>
                        </div>
                        <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-1">
                            <dt class="text-gray-500 dark:text-gray-400">Total Gaji</dt>
                        </div>
                        <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-2">
                            <dd class="font-medium dark:text-white">
                                <strong>Rp {{ number_format($salary->total_gaji, 2, ',', '.') }}</strong>
                            </dd>
                        </div>
                    </dl>

                    <!-- Buttons -->
                    <div class="flex space-x-4 mt-6">
                        <a href="{{ route('salaries.edit', $salary) }}"
                           class="px-5 py-2.5 text-sm font-medium text-center text-white bg-yellow-500 rounded-lg hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">
                            Edit
                        </a>
                        <form action="{{ route('salaries.destroy', $salary) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-5 py-2.5 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                                    onclick="return confirm('Yakin ingin menghapus data gaji ini?')">
                                Hapus
                            </button>
                        </form>
                        <a href="{{ route('salaries.index') }}"
                           class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                            Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection
</body>
</html>