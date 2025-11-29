@extends('master')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-gray-800 rounded-xl shadow-lg p-6">
        <h1 class="text-xl font-bold mb-6 text-white">Edit Gaji Karyawan</h1>

        <form action="{{ route('salaries.update', $salary) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-2 text-sm font-medium text-white">
                    Karyawan
                </label>
                <input type="text" 
                       value="{{ $salary->employee->nama_lengkap ?? 'Nama Tidak Ditemukan' }}" 
                       class="bg-gray-600 border border-gray-500 text-gray-300 text-sm rounded-lg block w-full p-2.5 cursor-not-allowed" 
                       readonly>
                
                </div>

            <div>
                <label class="block mb-2 text-sm font-medium text-white">
                    Bulan
                </label>
                <input type="text" value="{{ $salary->bulan }}" 
                       class="bg-gray-600 border border-gray-500 text-gray-300 text-sm rounded-lg block w-full p-2.5 cursor-not-allowed"
                       readonly>
            </div>

            <div>
                <label for="gaji_pokok" class="block mb-2 text-sm font-medium text-white">
                    Gaji Pokok
                </label>
                <input type="number" name="gaji_pokok" id="gaji_pokok"
                       value="{{ $salary->gaji_pokok }}" 
                       class="bg-gray-600 border border-gray-500 text-gray-300 text-sm rounded-lg block w-full p-2.5 cursor-not-allowed"
                       readonly>
                <p class="mt-1 text-xs text-gray-400">*Gaji pokok tidak dapat diubah di sini.</p>
            </div>

            <div>
                <label for="tunjangan" class="block mb-2 text-sm font-medium text-white">
                    Tunjangan
                </label>
                <input type="number" step="0.01" name="tunjangan" id="tunjangan"
                       value="{{ old('tunjangan', $salary->tunjangan) }}"
                       class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @error('tunjangan')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="potongan" class="block mb-2 text-sm font-medium text-white">
                    Potongan
                </label>
                <input type="number" step="0.01" name="potongan" id="potongan"
                       value="{{ old('potongan', $salary->potongan) }}"
                       class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                @error('potongan')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <a href="{{ route('salaries.index') }}"
                   class="px-5 py-2.5 text-sm font-medium text-gray-300 bg-gray-700 border border-gray-600 rounded-lg hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-500">
                    Batal
                </a>
                <button type="submit"
                        class="px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection