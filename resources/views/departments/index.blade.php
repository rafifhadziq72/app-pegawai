<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Departemen</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-900 text-white">
    @extends('master')
    @section('content')
    <section class="p-3 sm:p-5 antialiased">
        <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">
            <div class="bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <!-- Header -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 border-b border-gray-700">
                    <div class="w-full">
                        <h1 class="text-xl font-bold">Daftar Departemen</h1>
                    </div>
                    <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <a href="{{ route('departments.create') }}"
                           class="flex items-center justify-center text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                            </svg>
                            Tambah Departemen Baru
                        </a>
                    </div>
                </div>

                <!-- Search Section -->
                <div class="p-4 border-t border-gray-700">
                    <form method="GET" action="{{ route('departments.index') }}" class="flex flex-col md:flex-row gap-4">
                        <div class="flex-grow">
                            <label for="search" class="block mb-2 text-sm font-medium">Cari Departemen</label>
                            <div class="relative">
                                <input 
                                    type="text" 
                                    id="search" 
                                    name="search" 
                                    value="{{ request('search') }}"
                                    placeholder="Cari berdasarkan ID atau nama departemen..." 
                                    class="block w-full p-2 pl-10 text-sm text-white border border-gray-600 rounded-lg bg-gray-700 focus:ring-blue-500 focus:border-blue-500"
                                >
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-end">
                            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 w-full">
                                Cari
                            </button>
                        </div>
                        @if(request('search'))
                        <div class="flex items-end">
                            <a href="{{ route('departments.index') }}" 
                               class="text-gray-300 bg-gray-700 hover:bg-gray-600 border border-gray-600 focus:ring-4 focus:ring-gray-500 font-medium rounded-lg text-sm px-4 py-2 w-full">
                                Clear
                            </a>
                        </div>
                        @endif
                    </form>
                    
                    <!-- Search Results Info -->
                    @if(request('search'))
                    <div class="mt-3 text-sm text-gray-300">
                        Menemukan {{ $departments->total() }} hasil untuk pencarian: "{{ request('search') }}"
                    </div>
                    @endif
                </div>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="p-4 mx-4 bg-green-900 border border-green-800 text-green-200 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Table Container -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-300">
                        <thead class="text-xs text-gray-400 uppercase bg-gray-700">
                            <tr>
                                <th scope="col" class="px-4 py-3">ID</th>
                                <th scope="col" class="px-4 py-3">Nama Departemen</th>
                                <th scope="col" class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($departments as $department)
                            <tr class="border-b border-gray-700 hover:bg-gray-700">
                                <td class="px-4 py-3 font-medium">
                                    {{ $department->id }}
                                </td>
                                <td class="px-4 py-3">
                                    {{ $department->nama_departemen }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('departments.show', $department->id) }}"
                                           class="text-blue-400 hover:text-blue-300">
                                            Detail
                                        </a>
                                        <a href="{{ route('departments.edit', $department->id) }}"
                                           class="text-yellow-400 hover:text-yellow-300">
                                            Edit
                                        </a>
                                        <form action="{{ route('departments.destroy', $department->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-400 hover:text-red-300"
                                                    onclick="return confirm('Yakin ingin menghapus?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-4 py-8 text-center text-gray-400">
                                    @if(request('search'))
                                        Tidak ada data departemen yang cocok dengan pencarian "{{ request('search') }}".
                                    @else
                                        Tidak ada data departemen.
                                    @endif
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($departments->hasPages())
                <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4 border-t border-gray-700" aria-label="Table navigation">
                    <span class="text-sm font-normal text-gray-400">
                        Showing <span class="font-medium text-white">{{ $departments->firstItem() }}</span> to <span class="font-medium text-white">{{ $departments->lastItem() }}</span> of <span class="font-medium text-white">{{ $departments->total() }}</span>
                    </span>
                    <ul class="inline-flex items-stretch -space-x-px">
                        @if ($departments->onFirstPage())
                            <li>
                                <span class="flex items-center justify-center px-3 h-full text-gray-400 bg-gray-700 border border-gray-600 rounded-l-lg leading-tight">
                                    <span class="sr-only">Previous</span>
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $departments->previousPageUrl() }}"
                                   class="flex items-center justify-center px-3 h-full text-gray-400 bg-gray-700 border border-gray-600 hover:bg-gray-600 hover:text-white leading-tight">
                                    <span class="sr-only">Previous</span>
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </li>
                        @endif

                        @foreach ($departments->links()->elements[0] as $page => $url)
                            @if ($page == $departments->currentPage())
                                <li>
                                    <span class="z-10 flex items-center justify-center px-3 py-2 text-sm leading-tight text-blue-600 bg-blue-50 border border-blue-300 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">
                                        {{ $page }}
                                    </span>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $url }}"
                                       class="flex items-center justify-center px-3 py-2 text-sm leading-tight text-gray-400 bg-gray-700 border border-gray-600 hover:bg-gray-600 hover:text-white">
                                        {{ $page }}
                                    </a>
                                </li>
                            @endif
                        @endforeach

                        @if ($departments->hasMorePages())
                            <li>
                                <a href="{{ $departments->nextPageUrl() }}"
                                   class="flex items-center justify-center px-3 h-full text-gray-400 bg-gray-700 border border-gray-600 hover:bg-gray-600 hover:text-white leading-tight">
                                    <span class="sr-only">Next</span>
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </li>
                        @else
                            <li>
                                <span class="flex items-center justify-center px-3 h-full text-gray-400 bg-gray-700 border border-gray-600 rounded-r-lg leading-tight">
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