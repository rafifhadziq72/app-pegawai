<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jabatan</title>
    @vite(['resources/css/app.css'])
    <!-- Jika kamu menggunakan FlowBite JS/CSS via NPM, uncomment baris di bawah -->
    <!-- @vite(['resources/js/app.js']) -->
    <!-- <link rel="stylesheet" href="path/to/flowbite.min.css" /> -->
</head>
<body class="bg-gray-50 dark:bg-gray-900">
    @extends('master')
    @section('title', 'Tambah Jabatan')
    @section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
            <h1 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Form Tambah Jabatan</h1>

            <form action="{{ route('positions.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 gap-6">
                    <!-- Nama Jabatan -->
                    <div>
                        <label for="nama_jabatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Nama Jabatan
                        </label>
                        <input type="text" name="nama_jabatan" id="nama_jabatan" value="{{ old('nama_jabatan') }}" required
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        @error('nama_jabatan')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gaji Pokok -->
                    <div>
                        <label for="gaji_pokok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Gaji Pokok
                        </label>
                        <input type="number" name="gaji_pokok" id="gaji_pokok" value="{{ old('gaji_pokok') }}" min="0" step="1000" required
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                        @error('gaji_pokok')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('positions.index') }}"
                       class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-5 py-2.5 text-sm font-medium text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endsection
</body>
</html>