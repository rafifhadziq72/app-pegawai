{{-- resources/views/salaries/create.blade.php --}}
@extends('master')
@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
        <h1 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Tambah Gaji Karyawan</h1>
        <form action="{{ route('salaries.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label for="karyawan_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Karyawan
                    </label>
                    <select name="karyawan_id" id="karyawan_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}"
                                    data-position-gaji-pokok="{{ $employee->position->gaji_pokok ?? 0 }}"
                                    {{ request('employee_id') == $employee->id ? 'selected' : '' }}>
                                {{ $employee->nama_lengkap }}
                            </option>
                        @endforeach
                    </select>
                    @error('karyawan_id')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bulan -->
                <div>
                    <label for="bulan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Bulan
                    </label>
                    <input type="text" name="bulan" id="bulan" value="{{ old('bulan') }}"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                           placeholder="Contoh: Januari 2025" required>
                    @error('bulan')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Gaji Pokok -->
                <div>
                    <label for="gaji_pokok" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Gaji Pokok
                    </label>
                    <input type="number" step="0.01" name="gaji_pokok" id="gaji_pokok" value="{{ old('gaji_pokok') }}"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                    @error('gaji_pokok')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tunjangan -->
                <div>
                    <label for="tunjangan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Tunjangan
                    </label>
                    <input type="number" step="0.01" name="tunjangan" id="tunjangan" value="{{ old('tunjangan', 0) }}"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    @error('tunjangan')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Potongan -->
                <div>
                    <label for="potongan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Potongan
                    </label>
                    <input type="number" step="0.01" name="potongan" id="potongan" value="{{ old('potongan', 0) }}"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    @error('potongan')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

            </div>
            <!-- Buttons -->
            <div class="flex justify-end space-x-3 pt-4">
                <a href="{{ route('salaries.index') . (request('employee_id') ? '?employee_id=' . request('employee_id') : '') }}" 
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
<script>
document.addEventListener('DOMContentLoaded', function () {
    const karyawanSelect = document.getElementById('karyawan_id');
    const gajiPokokInput = document.getElementById('gaji_pokok');

    // Update gaji_pokok on page load if an employee is pre-selected
    updateGajiPokok();

    karyawanSelect.addEventListener('change', updateGajiPokok);

    function updateGajiPokok() {
        const selectedOption = karyawanSelect.options[karyawanSelect.selectedIndex];
        if (selectedOption) {
            const salaryValue = selectedOption.getAttribute('data-position-gaji-pokok');
            gajiPokokInput.value = salaryValue || '';
        } else {
            gajiPokokInput.value = '';
        }
    }
});
</script>
@endsection