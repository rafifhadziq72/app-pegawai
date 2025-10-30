{{-- resources/views/salaries/create.blade.php --}}
@extends('master')

@section('content')
<div class="container">
    <h1>Tambah Gaji Karyawan</h1>

    <form action="{{ route('salaries.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="karyawan_id" class="form-label">Karyawan</label>
            <select name="karyawan_id" id="karyawan_id" class="form-control" required>
                <option value="">-- Pilih Karyawan --</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" data-position-gaji-pokok="{{ $employee->position->gaji_pokok ?? 0 }}">
                        {{ $employee->nama_lengkap }}
                    </option>
                @endforeach
            </select>
            @error('karyawan_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="bulan" class="form-label">Bulan</label>
            <input type="text" name="bulan" id="bulan" class="form-control" placeholder="Contoh: Januari 2025" value="{{ old('bulan') }}" required>
            @error('bulan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
            <input type="number" step="0.01" name="gaji_pokok" id="gaji_pokok" class="form-control" value="{{ old('gaji_pokok') }}" required>
            @error('gaji_pokok')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tunjangan" class="form-label">Tunjangan</label>
            <input type="number" step="0.01" name="tunjangan" id="tunjangan" class="form-control" value="{{ old('tunjangan', 0) }}">
            @error('tunjangan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="potongan" class="form-label">Potongan</label>
            <input type="number" step="0.01" name="potongan" id="potongan" class="form-control" value="{{ old('potongan', 0) }}">
            @error('potongan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('salaries.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const karyawanSelect = document.getElementById('karyawan_id');
    const gajiPokokInput = document.getElementById('gaji_pokok');

    karyawanSelect.addEventListener('change', function () {
        const selectedKaryawanId = this.value;

        if (selectedKaryawanId) {
            // Get the salary value from the data attribute of the selected option
            const selectedOption = this.options[this.selectedIndex];
            const salaryValue = selectedOption.getAttribute('data-position-gaji-pokok');
            gajiPokokInput.value = salaryValue;
        } else {
            // Clear the input if no employee is selected
            gajiPokokInput.value = '';
        }
    });
});
</script>
@endsection