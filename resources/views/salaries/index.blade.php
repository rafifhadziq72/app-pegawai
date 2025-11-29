@extends('master')
@section('content')

<div class="bg-gray-800 text-white p-6 rounded-lg shadow-md">

    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold">Daftar Gaji Karyawan</h1>
        <a href="{{ route('salaries.create') . (request('employee_id') ? '?employee_id=' . request('employee_id') : '') }}"
           class="flex items-center text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg text-sm font-medium transition">
            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd" fill-rule="evenodd"
                      d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 01-2 0v-5H4a1 1 0 010-2h5V4a1 1 0 011-1z" />
            </svg>
            Tambah Gaji
        </a>
    </div>

    <!-- Search Bar -->
    <div class="mb-6">
        <label class="block text-sm font-medium mb-2">Cari Gaji</label>
        <form method="GET" action="{{ route('salaries.index') }}" class="flex gap-2">
            <!-- Preserve employee_id filter if present -->
            @if(request('employee_id'))
                <input type="hidden" name="employee_id" value="{{ request('employee_id') }}">
            @endif
            <div class="relative flex-grow">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}"
                       class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                       placeholder="Cari berdasarkan nama karyawan, bulan, atau jumlah gaji..."
                       autocomplete="off">
            </div>
            <div class="flex items-end">
                            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 w-full">
                                Cari
                            </button>
                        </div>
        </form>
    </div>

    <!-- Optional: Filter Indicators -->
    @if(request('employee_id'))
        @php
            $filteredEmployee = \App\Models\Employee::find(request('employee_id'));
        @endphp
        <div class="mb-4 p-3 bg-blue-900 text-blue-200 rounded-lg">
            <p>Menampilkan gaji untuk: <strong>{{ $filteredEmployee->nama_lengkap ?? 'Karyawan Tidak Ditemukan' }}</strong></p>
            <a href="{{ route('salaries.index', ['search' => request('search')]) }}" class="text-blue-400 underline">Lihat Semua</a>
        </div>
    @endif

    @if(request('search'))
        <div class="mb-4 p-3 bg-blue-900 text-blue-200 rounded-lg">
            <p>Hasil pencarian untuk: <strong>"{{ request('search') }}"</strong></p>
            <a href="{{ route('salaries.index', ['employee_id' => request('employee_id')]) }}" class="text-blue-400 underline">Reset pencarian</a>
        </div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-300">
            <thead class="text-xs uppercase bg-gray-700 text-gray-300">
                <tr>
                    <th scope="col" class="px-6 py-3">KARYAWAN</th>
                    <th scope="col" class="px-6 py-3">BULAN</th>
                    <th scope="col" class="px-6 py-3">GAJI POKOK</th>
                    <th scope="col" class="px-6 py-3">TUNJANGAN</th>
                    <th scope="col" class="px-6 py-3">POTONGAN</th>
                    <th scope="col" class="px-6 py-3">TOTAL GAJI</th>
                    <th scope="col" class="px-6 py-3">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse($salaries as $salary)
                <tr class="border-b border-gray-700 hover:bg-gray-700">
                    <td class="px-6 py-4">{{ $salary->employee->nama_lengkap ?? 'Tidak diketahui' }}</td>
                    <td class="px-6 py-4">{{ $salary->bulan }}</td>
                    <td class="px-6 py-4">Rp {{ number_format($salary->gaji_pokok, 2, ',', '.') }}</td>
                    <td class="px-6 py-4">Rp {{ number_format($salary->tunjangan, 2, ',', '.') }}</td>
                    <td class="px-6 py-4">Rp {{ number_format($salary->potongan, 2, ',', '.') }}</td>
                    <td class="px-6 py-4"><strong>Rp {{ number_format($salary->total_gaji, 2, ',', '.') }}</strong></td>
                    <td class="px-6 py-4 space-x-2">
                        <a href="{{ route('salaries.show', $salary) }}" class="text-blue-500 hover:underline">Detail</a>
                        <a href="{{ route('salaries.edit', $salary) }}" class="text-yellow-500 hover:underline">Edit</a>
                        <form action="{{ route('salaries.destroy', $salary) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline"
                                    onclick="return confirm('Yakin ingin menghapus data gaji ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-400">
                        @if(request('search'))
                            Tidak ditemukan hasil untuk "{{ request('search') }}".<br>
                            <a href="{{ route('salaries.index', ['employee_id' => request('employee_id')]) }}" class="text-blue-400 underline">Reset pencarian</a>
                        @elseif(request('employee_id'))
                            Tidak ada data gaji untuk karyawan yang dipilih.
                        @else
                            Tidak ada data gaji.
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $salaries->appends(request()->query())->links() }}
    </div>

</div>

@endsection