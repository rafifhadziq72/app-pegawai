@extends('master')

@section('content')
<div class="container">
    <h1>Detail Gaji Karyawan</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Karyawan:</strong> {{ $salary->employee->nama ?? 'Tidak diketahui' }}</p>
            <p><strong>Bulan:</strong> {{ $salary->bulan }}</p>
            <p><strong>Gaji Pokok:</strong> Rp {{ number_format($salary->gaji_pokok, 2, ',', '.') }}</p>
            <p><strong>Tunjangan:</strong> Rp {{ number_format($salary->tunjangan, 2, ',', '.') }}</p>
            <p><strong>Potongan:</strong> Rp {{ number_format($salary->potongan, 2, ',', '.') }}</p>
            <p><strong>Total Gaji:</strong> <strong>Rp {{ number_format($salary->total_gaji, 2, ',', '.') }}</strong></p>
        </div>
    </div>

    <a href="{{ route('salaries.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar</a>
</div>
@endsection