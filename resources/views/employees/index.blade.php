<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pegawai</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-50 dark:bg-gray-900">
    @extends('master')
    @section('title', 'Daftar Pegawai')
    @section('content')

        <!-- Main Content Container - Match Salary Index Structure -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">

            <!-- Header Section - Match Salary Index -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">Daftar Pegawai</h1>
                <a href="{{ route('employees.create') }}"
                   class="flex items-center text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg text-sm font-medium transition">
                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                              d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 01-2 0v-5H4a1 1 0 010-2h5V4a1 1 0 011-1z" />
                    </svg>
                    Tambah Pegawai Baru
                </a>
            </div>

            <!-- Search Section - Match Salary Index -->
            <div class="mb-6">
                <label class="block text-sm font-medium mb-2">Cari Pegawai</label>
                <form method="GET" action="{{ route('employees.index') }}" class="flex gap-2">
                    <div class="relative flex-grow">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="Cari berdasarkan nama, email, nomor telepon, alamat, departemen, atau jabatan..."
                               autocomplete="off">
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 w-full">
                            Cari
                        </button>
                    </div>
                    @if(request('search'))
                        <div class="flex items-end">
                            <a href="{{ route('employees.index') }}"
                               class="text-gray-900 bg-gray-100 hover:bg-gray-200 border border-gray-300 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-700 w-full">
                                Clear
                            </a>
                        </div>
                    @endif
                </form>
            </div>

            <!-- Optional: Search Results Info -->
            @if(request('search'))
                <div class="mb-4 p-3 bg-blue-900 text-blue-200 rounded-lg">
                    <p>Hasil pencarian untuk: <strong>"{{ request('search') }}"</strong></p>
                    <a href="{{ route('employees.index') }}" class="text-blue-400 underline">Reset pencarian</a>
                </div>
            @endif

            <!-- Table Container -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nama Lengkap</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">Nomor Telepon</th>
                            <th scope="col" class="px-6 py-3">Tanggal Lahir</th>
                            <th scope="col" class="px-6 py-3">Alamat</th> <!-- Kept reduced padding -->
                            <th scope="col" class="px-6 py-3">Tanggal Masuk</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Departemen</th>
                            <th scope="col" class="px-6 py-3">Jabatan</th>
                            <th scope="col" class="px-6 py-3">Gaji</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $employee)
                            <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $employee->nama_lengkap }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $employee->email }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $employee->nomor_telepon }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($employee->tanggal_lahir)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="truncate block max-w-[150px]">{{ $employee->alamat }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($employee->tanggal_masuk)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="bg-{{ $employee->status == 'aktif' ? 'green' : 'red' }}-100 text-{{ $employee->status == 'aktif' ? 'green' : 'red' }}-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-{{ $employee->status == 'aktif' ? 'green' : 'red' }}-900 dark:text-{{ $employee->status == 'aktif' ? 'green' : 'red' }}-200">
                                        {{ ucfirst($employee->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="truncate block max-w-[120px]">{{ $employee->department ? $employee->department->nama_departemen : '-' }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="truncate block max-w-[120px]">{{ $employee->position ? $employee->position->nama_jabatan : '-' }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('salaries.index', ['employee_id' => $employee->id]) }}"
                                       class="text-green-600 hover:text-green-900 dark:text-green-500 dark:hover:text-green-700">
                                        Lihat Gaji
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('employees.show', $employee->id) }}"
                                           class="text-blue-600 hover:text-blue-900 dark:text-blue-500 dark:hover:text-blue-700">
                                            Detail
                                        </a>
                                        <a href="{{ route('employees.edit', $employee->id) }}"
                                           class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-500 dark:hover:text-yellow-700">
                                            Edit
                                        </a>
                                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-600 hover:text-red-900 dark:text-red-500 dark:hover:text-red-700"
                                                    onclick="return confirm('Yakin ingin menghapus?')">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                    @if(request('search'))
                                        Tidak ada data pegawai yang cocok dengan pencarian "{{ request('search') }}".
                                    @else
                                        Tidak ada data pegawai.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($employees->hasPages())
                <div class="mt-4">
                    {{ $employees->appends(request()->query())->links() }}
                </div>
            @endif

        </div> <!-- End of main content container -->

    @endsection
</body>

</html>