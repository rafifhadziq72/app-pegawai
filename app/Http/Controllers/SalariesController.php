<?php

namespace App\Http\Controllers;

use App\Models\Salaries;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalariesController extends Controller
{
    public function index()
    {
        $salaries = Salaries::with('employee')->latest()->paginate(10);
        return view('salaries.index', compact('salaries'));
    }
    public function create()
    {
        $employees = Employee::all();
        return view('salaries.create', compact('employees'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|string|max:10',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'nullable|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
        ]);
        $employee = Employee::with('position')->findOrFail($request->karyawan_id);
        $gaji_pokok = $employee->position->gaji_pokok ?? 0;
        $tunjangan = $request->tunjangan ?? 0;
        $potongan = $request->potongan ?? 0;
        $total_gaji = $gaji_pokok + $tunjangan - $potongan;

        Salaries::create([
            'karyawan_id' => $employee->id,
            'bulan' => $request->bulan,
            'gaji_pokok' => $gaji_pokok,
            'tunjangan' => $tunjangan,
            'potongan' => $potongan,
            'total_gaji' => $total_gaji,
        ]);
        Salaries::create($validated);

        return redirect()->route('salaries.index')->with('success', 'Gaji berhasil disimpan!');
    }
    public function edit(Salaries $salary)
    {
        $employees = Employee::all();
        return view('salaries.edit', compact('salary', 'employees'));
    }
    public function update(Request $request, Salaries $salary)
    {
        $validated = $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|string|max:10',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'nullable|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
        ]);

        $salary->update($validated);

        return redirect()->route('salaries.index')->with('success', 'Gaji berhasil diperbarui!');
    }
    public function getSalary($id)
    {
        // Find the employee by ID and load their position relationship
        $employee = Employee::with('position')->find($id);

        if ($employee && $employee->position) {
            // Return the gaji_pokok from the associated position
            return response()->json(['gaji_pokok' => $employee->position->gaji_pokok]);
        } else {
            // If employee or position is not found, return a default value or null/error
            return response()->json(['gaji_pokok' => null], 404); // Or return 0 or a default message
        }
    }
    public function destroy(Salaries $salary)
    {
        $salary->delete();
        return redirect()->route('salaries.index')->with('success', 'Gaji berhasil dihapus!');
    }
}
