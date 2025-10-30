<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Absensi</title>
    @vite(['resources/css/app.css'])
   </head>

<body class="bg-gray-50 dark:bg-gray-900">
    @extends('master')
    @section('title', 'Edit Absensi')
    @section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
            <h1 class="text-xl font-bold text-gray-900 dark:text-white mb-6">
                Edit Absensi: {{ $attendance->employee->nama_lengkap ?? 'Tidak diketahui' }}
            </h1>

            <form action="{{ route('attendances.update', $attendance->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="karyawan_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Karyawan
                        </label>
                        <select name="karyawan_id" id="karyawan_id" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            <option value="">-- Pilih Karyawan --</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}"
                                    {{ old('karyawan_id', $attendance->karyawan_id) == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->nama_lengkap }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Tanggal
                        </label>
                        <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', $attendance->tanggal->format('Y-m-d')) }}" required
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    </div>

                    <div>
                        <label for="waktu_masuk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Waktu Masuk
                        </label>
                        <input type="time" id="waktu_masuk" name="waktu_masuk" value="{{ old('waktu_masuk', $attendance->waktu_masuk) }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    </div>

                    <div>
                        <label for="waktu_keluar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Waktu Keluar
                        </label>
                        <input type="time" id="waktu_keluar" name="waktu_keluar" value="{{ old('waktu_keluar', $attendance->waktu_keluar) }}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    </div>

                    <div>
                        <label for="status_absensi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Status Absensi
                        </label>
                        <select name="status_absensi" id="status_absensi" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                            <option value="hadir" {{ old('status_absensi', $attendance->status_absensi) == 'hadir' ? 'selected' : '' }}>Hadir</option>
                            <option value="izin" {{ old('status_absensi', $attendance->status_absensi) == 'izin' ? 'selected' : '' }}>Izin</option>
                            <option value="sakit" {{ old('status_absensi', $attendance->status_absensi) == 'sakit' ? 'selected' : '' }}>Sakit</option>
                            <option value="alpha" {{ old('status_absensi', $attendance->status_absensi) == 'alpha' ? 'selected' : '' }}>Alpha</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('attendances.index') }}"
                       class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-600 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                        Batal
                    </a>
                    <button type="submit"
                            class="px-5 py-2.5 text-sm font-medium text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endsection
</body>
</html>