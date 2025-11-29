<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::with('employee');

        // Handle search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('tanggal', 'LIKE', "%{$search}%")
                  ->orWhere('waktu_masuk', 'LIKE', "%{$search}%")
                  ->orWhere('waktu_keluar', 'LIKE', "%{$search}%")
                  ->orWhere('status_absensi', 'LIKE', "%{$search}%")
                  ->orWhereHas('employee', function($empQuery) use ($search) {
                      $empQuery->where('nama_lengkap', 'LIKE', "%{$search}%")
                               ->orWhere('email', 'LIKE', "%{$search}%")
                               ->orWhere('nomor_telepon', 'LIKE', "%{$search}%");
                  });
            });
        }

        $attendances = $query->latest()->paginate(10);
        
        return view('attendances.index', compact('attendances'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('attendances.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id'   => 'required|exists:employees,id',
            'tanggal'       => 'required|date',
            'waktu_masuk'   => 'nullable|date_format:H:i',
            'waktu_keluar'  => 'nullable|date_format:H:i',
            'status_absensi'=> 'required|in:hadir,izin,sakit,alpha',
        ]);

        $validated = $request->only([
            'karyawan_id','tanggal','waktu_masuk','waktu_keluar','status_absensi'
        ]);

        if (empty($validated['waktu_masuk'])) {
            $validated['waktu_masuk'] = now()->format('H:i');
        }

        $validated['waktu_keluar'] = $validated['waktu_keluar'] ?: null;

        Attendance::create($validated);

        return redirect()->route('attendances.index')->with('success', 'Absensi berhasil dicatat.');
    }

    public function show(Attendance $attendance)
    {
        return view('attendances.show', compact('attendance'));
    }

    public function edit(Attendance $attendance)
    {
        $employees = Employee::all();
        return view('attendances.edit', compact('attendance', 'employees'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'tanggal' => 'required|date',
            'waktu_masuk' => 'nullable|date_format:H:i:s',
            'waktu_keluar' => 'nullable|date_format:H:i:s',
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha',
        ]);

        $attendance->update($validated);

        return redirect()->route('attendances.index')->with('success', 'Absensi berhasil diperbarui.');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()->route('attendances.index')->with('success', 'Absensi berhasil dihapus.');
    }
}