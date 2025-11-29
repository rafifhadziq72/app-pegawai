<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::query();

        // Handle search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('nomor_telepon', 'LIKE', "%{$search}%")
                  ->orWhere('alamat', 'LIKE', "%{$search}%")
                  ->orWhereHas('department', function($deptQuery) use ($search) {
                      $deptQuery->where('nama_departemen', 'LIKE', "%{$search}%");
                  })
                  ->orWhereHas('position', function($posQuery) use ($search) {
                      $posQuery->where('nama_jabatan', 'LIKE', "%{$search}%");
                  });
            });
        }

        $employees = $query->latest()->paginate(5);

        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = \App\Models\Department::all();
        $positions = \App\Models\Position::all();
        return view('employees.create', compact('departments', 'positions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|string|max:50',
            'departemen_id'=>'nullable|exists:departments,id',
            'jabatan_id'=>'nullable|exists:positions,id',
        ]);
        Employee::create($request->all());
        return redirect()->route('employees.index');
    }

    public function show(string $id)
    {
        $employee = Employee::find($id);
        return view('employees.show', compact('employee'));
    }

    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return redirect()->route('employees.index');
    }

    public function edit(string $id)
    {
        $employee = Employee::find($id);
        $departments = \App\Models\Department::all();
        $positions = \App\Models\Position::all();
        return view('employees.edit', compact('employee','departments','positions'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|string|max:50',
            'departemen_id'=>'nullable|exists:departments,id',
            'jabatan_id'=>'nullable|exists:positions,id',
        ]);
        $employee = Employee::findOrFail($id);
        $employee->update($request->only([
            'nama_lengkap',
            'email',
            'nomor_telepon',
            'tanggal_lahir',
            'alamat',
            'tanggal_masuk',
            'status',
            'departemen_id',
            'jabatan_id',
        ]));
        return redirect()->route('employees.index');
    }
}