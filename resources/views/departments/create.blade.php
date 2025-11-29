<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Departemen</title>
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-900 text-white">
    @extends('master')
    @section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-gray-800 rounded-xl shadow-lg p-6">
            <h1 class="text-xl font-bold mb-6">Form Input Departemen</h1>

            <form action="{{ route('departments.store') }}" method="POST" class="space-y-6">
                @csrf
                <!-- Nama Departemen Input -->
                <div>
                    <label for="nama_departemen" class="block mb-2 text-sm font-medium">
                        Nama Departemen
                    </label>
                    <input type="text" name="nama_departemen" id="nama_departemen"
                           value="{{ old('nama_departemen') }}" required
                           class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    @error('nama_departemen')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('departments.index') }}"
                       class="px-5 py-2.5 text-sm font-medium text-gray-300 bg-gray-700 border border-gray-600 rounded-lg hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-500">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endsection
</body>
</html>