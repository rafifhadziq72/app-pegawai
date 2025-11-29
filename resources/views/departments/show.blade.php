<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Departemen</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-900 text-white">
    @extends('master')
    @section('content')
    <section class="p-3 sm:p-5 antialiased">
        <div class="mx-auto max-w-4xl px-4 lg:px-12">
            <div class="bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <!-- Header -->
                <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 border-b border-gray-700">
                    <div class="w-full">
                        <h1 class="text-xl font-bold">Detail Departemen</h1>
                    </div>
                </div>

                <!-- Detail Content -->
                <div class="p-6">
                    <dl class="grid max-w-screen-lg mx-auto text-gray-300 divide-y divide-gray-700 sm:grid-cols-3 sm:gap-4">
                        <div class="flex flex-col pb-3 sm:gap-1 sm:col-span-1">
                            <dt class="text-gray-400">ID</dt>
                        </div>
                        <div class="flex flex-col pb-3 sm:gap-1 sm:col-span-2">
                            <dd class="font-medium">
                                {{ $department->id }}
                            </dd>
                        </div>

                        <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-1">
                            <dt class="text-gray-400">Nama Departemen</dt>
                        </div>
                        <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-2">
                            <dd class="font-medium">
                                {{ $department->nama_departemen }}
                            </dd>
                        </div>

                        <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-1">
                            <dt class="text-gray-400">Dibuat Pada</dt>
                        </div>
                        <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-2">
                            <dd class="font-medium">
                                {{ $department->created_at }}
                            </dd>
                        </div>

                        <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-1">
                            <dt class="text-gray-400">Diubah Pada</dt>
                        </div>
                        <div class="flex flex-col pt-3 pb-3 sm:gap-1 sm:col-span-2">
                            <dd class="font-medium">
                                {{ $department->updated_at }}
                            </dd>
                        </div>
                    </dl>

                    <!-- Buttons -->
                    <div class="flex space-x-4 mt-6">
                        <a href="{{ route('departments.edit', $department->id) }}"
                           class="px-5 py-2.5 text-sm font-medium text-center text-white bg-yellow-600 rounded-lg hover:bg-yellow-700 focus:ring-4 focus:outline-none focus:ring-yellow-300">
                            Edit
                        </a>
                        <a href="{{ route('departments.index') }}"
                           class="px-5 py-2.5 text-sm font-medium text-gray-300 bg-gray-700 border border-gray-600 rounded-lg hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-500">
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