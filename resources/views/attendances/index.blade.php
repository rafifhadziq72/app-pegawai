<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Absensi</title>
    @vite(['resources/css/app.css'])
    </head>
<body class="bg-gray-50 dark:bg-gray-900">
    @extends('master')
    @section('title', 'Daftar Absensi')
    @section('content')
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased">
        <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full">
                        <h1 class="text-xl font-bold text-gray-900 dark:text-white">Daftar Absensi</h1>
                    </div>
                    <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <a href="{{ route('attendances.create') }}"
                           class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Catat Absensi Baru
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">Tanggal</th>
                                <th scope="col" class="px-4 py-3">Karyawan</th>
                                <th scope="col" class="px-4 py-3">Waktu Masuk</th>
                                <th scope="col" class="px-4 py-3">Waktu Keluar</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attendances as $attendance)
                            <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $attendance->tanggal->format('d-m-Y') }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $attendance->employee->nama_lengkap ?? 'Tidak diketahui' }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $attendance->waktu_masuk ?? '-' }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $attendance->waktu_keluar ?? '-' }}
                                </td>
                                <td class="px-4 py-3">
                                    <span class="bg-{{ 
                                        $attendance->status_absensi == 'hadir' ? 'green' :
                                        ($attendance->status_absensi == 'izin' ? 'yellow' :
                                        ($attendance->status_absensi == 'sakit' ? 'red' : 'gray'))
                                    }}-100 text-{{ 
                                        $attendance->status_absensi == 'hadir' ? 'green' :
                                        ($attendance->status_absensi == 'izin' ? 'yellow' :
                                        ($attendance->status_absensi == 'sakit' ? 'red' : 'gray'))
                                    }}-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-{{ 
                                        $attendance->status_absensi == 'hadir' ? 'green' :
                                        ($attendance->status_absensi == 'izin' ? 'yellow' :
                                        ($attendance->status_absensi == 'sakit' ? 'red' : 'gray'))
                                    }}-900 dark:text-{{ 
                                        $attendance->status_absensi == 'hadir' ? 'green' :
                                        ($attendance->status_absensi == 'izin' ? 'yellow' :
                                        ($attendance->status_absensi == 'sakit' ? 'red' : 'gray'))
                                    }}-200">
                                        {{ ucfirst($attendance->status_absensi) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('attendances.show', $attendance->id) }}"
                                           class="text-blue-600 hover:text-blue-900 dark:text-blue-500 dark:hover:text-blue-700">
                                            Detail
                                        </a>
                                        <a href="{{ route('attendances.edit', $attendance->id) }}"
                                           class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-500 dark:hover:text-yellow-700">
                                            Edit
                                        </a>
                                        <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-600 hover:text-red-900 dark:text-red-500 dark:hover:text-red-700"
                                                    onclick="return confirm('Yakin ingin menghapus?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                                    Tidak ada data absensi.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($attendances->hasPages())
                <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                        Showing <span class="font-medium text-gray-900 dark:text-white">{{ $attendances->firstItem() }}</span> to <span class="font-medium text-gray-900 dark:text-white">{{ $attendances->lastItem() }}</span> of <span class="font-medium text-gray-900 dark:text-white">{{ $attendances->total() }}</span>
                    </span>
                    <ul class="inline-flex items-stretch -space-x-px">
                        @if ($attendances->onFirstPage())
                            <li>
                                <span class="flex items-center justify-center px-3 h-full text-gray-500 bg-white border border-gray-300 rounded-l-lg leading-tight dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">
                                    <span class="sr-only">Previous</span>
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $attendances->previousPageUrl() }}"
                                   class="flex items-center justify-center px-3 h-full text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 leading-tight dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                    <span class="sr-only">Previous</span>
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </li>
                        @endif

                        @foreach ($attendances->links()->elements[0] as $page => $url)
                            @if ($page == $attendances->currentPage())
                                <li>
                                    <span class="z-10 flex items-center justify-center px-3 py-2 text-sm leading-tight text-primary-600 bg-primary-50 border border-primary-300 hover:bg-primary-100 hover:text-primary-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">
                                        {{ $page }}
                                    </span>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $url }}"
                                       class="flex items-center justify-center px-3 py-2 text-sm leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endif
                        @endforeach

                        @if ($attendances->hasMorePages())
                            <li>
                                <a href="{{ $attendances->nextPageUrl() }}"
                                   class="flex items-center justify-center px-3 h-full text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 leading-tight dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                    <span class="sr-only">Next</span>
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </li>
                        @else
                            <li>
                                <span class="flex items-center justify-center px-3 h-full text-gray-500 bg-white border border-gray-300 rounded-r-lg leading-tight dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">
                                    <span class="sr-only">Next</span>
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </li>
                        @endif
                    </ul>
                </nav>
                @endif
            </div>
        </div>
    </section>
    @endsection
</body>
</html>