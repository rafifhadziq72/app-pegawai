<?php

namespace App\Http\Controllers;

use App\Models\Salaries;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalariesController extends Controller
{
    public function index(Request $request)
{
    $query = Salaries::with('employee')->latest();

    // Check if employee_id filter is applied
    if ($request->has('employee_id') && $request->employee_id != '') {
        $query->where('karyawan_id', $request->employee_id);
    }

    // Add search functionality
    if ($request->has('search') && $request->search != '') {
        $searchTerm = $request->search;
        $query->where(function ($q) use ($searchTerm) {
            $q->whereHas('employee', function ($empQuery) use ($searchTerm) {
                $empQuery->where('nama_lengkap', 'like', "%{$searchTerm}%");
            })
            ->orWhere('bulan', 'like', "%{$searchTerm}%")
            ->orWhere('total_gaji', 'like', "%{$searchTerm}%");
        });
    }

    $salaries = $query->paginate(10);

    // Pass the filter and search values back to the view
    $filterEmployeeId = $request->employee_id ?? null;
    $searchTerm = $request->search ?? null;

    return view('salaries.index', compact('salaries', 'filterEmployeeId', 'searchTerm'));
}

    public function create()
    {
        $employees = Employee::with('position')->get();
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

        // Find the employee
        // $employee = Employee::with(relations: 'position')->findOrFail($request->karyawan_id);

        // Calculate values
        $gaji_pokok = $request->gaji_pokok; // Use position's base salary
        $tunjangan = $request->tunjangan ?? 0;
        $potongan = $request->potongan ?? 0;
        $total_gaji = $gaji_pokok + $tunjangan - $potongan;

        // Create the salary record
        Salaries::create([
            'karyawan_id' => $request->karyawan_id,
            'bulan' => $request->bulan,
            'gaji_pokok' => $gaji_pokok,
            'tunjangan' => $tunjangan,
            'potongan' => $potongan,
            'total_gaji' => $total_gaji,
        ]);

        // Salaries::create(attributes: $validated);

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
            // 'karyawan_id' => 'required|exists:employees,id',
            // 'bulan' => 'required|string|max:10',
            // 'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'nullable|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
        ]);

        $tunjangan = $request->tunjangan ?? 0;
        $potongan = $request->potongan ?? 0;
        $total_gaji = $salary->gaji_pokok + $tunjangan - $potongan;

        $salary->update([
            'tunjangan' => $tunjangan,
            'potongan' => $potongan,
            'total_gaji' => $total_gaji,
            // Kita TIDAK mengupdate 'karyawan_id', 'bulan', atau 'gaji_pokok'
            // agar data tersebut tetap aman.
        ]);
        // $salary->update($validated);

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
    public function show(Salaries $salary)
    {
        // Load the employee relationship
        $salary->load('employee');

        return view('salaries.show', compact('salary'));
    }
}
