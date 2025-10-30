@extends('master')

@section('content')
<div class="container">
    <h1>Edit Gaji Karyawan</h1>

    <form action="{{ route('salaries.update', $salary) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="karyawan_id" class="form-label">Karyawan</label>
            <select name="karyawan_id" id="karyawan_id" class="form-control" required>
                <option value="">-- Pilih Karyawan --</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $employee->id == $salary->karyawan_id ? 'selected' : '' }}>
                        {{ $employee->nama }}
                    </option>
                @endforeach
            </select>
            @error('karyawan_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="bulan" class="form-label">Bulan</label>
            <input type="text" name="bulan" id="bulan" class="form-control" placeholder="Contoh: Januari 2025" value="{{ old('bulan', $salary->bulan) }}" required>
            @error('bulan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
            <input type="number" step="0.01" name="gaji_pokok" id="gaji_pokok" class="form-control" value="{{ old('gaji_pokok', $salary->gaji_pokok) }}" required>
            @error('gaji_pokok')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tunjangan" class="form-label">Tunjangan</label>
            <input type="number" step="0.01" name="tunjangan" id="tunjangan" class="form-control" value="{{ old('tunjangan', $salary->tunjangan) }}">
            @error('tunjangan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="potongan" class="form-label">Potongan</label>
            <input type="number" step="0.01" name="potongan" id="potongan" class="form-control" value="{{ old('potongan', $salary->potongan) }}">
            @error('potongan')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
        <a href="{{ route('salaries.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection