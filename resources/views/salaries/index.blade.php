@extends('master')

@section('content')
<div class="container">
    <h1>Daftar Gaji Karyawan</h1>
    <a href="{{ route('salaries.create') }}" class="btn btn-primary mb-3">Tambah Gaji</a>

    <table class="table">
        <thead>
            <tr>
                <th>Karyawan</th>
                <th>Bulan</th>
                <th>Gaji Pokok</th>
                <th>Tunjangan</th>
                <th>Potongan</th>
                <th>Total Gaji</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($salaries as $salary)
            <tr>
                <td>{{ $salary->employee->nama ?? 'Tidak diketahui' }}</td>
                <td>{{ $salary->bulan }}</td>
                <td>Rp {{ number_format($salary->gaji_pokok, 2, ',', '.') }}</td>
                <td>Rp {{ number_format($salary->tunjangan, 2, ',', '.') }}</td>
                <td>Rp {{ number_format($salary->potongan, 2, ',', '.') }}</td>
                <td><strong>Rp {{ number_format($salary->total_gaji, 2, ',', '.') }}</strong></td>
                <td>
                    <a href="{{ route('salaries.edit', $salary) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('salaries.destroy', $salary) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada data gaji.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $salaries->links() }}
</div>
@endsection