<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Department::query();

        // Handle search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id', 'LIKE', "%{$search}%")
                  ->orWhere('nama_departemen', 'LIKE', "%{$search}%");
            });
        }

        $departments = $query->oldest()->paginate(5);

        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_departemen' => 'required|string|max:100',
        ]);
        Department::create($request->all());
        return redirect()->route('departments.index');
    }

    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }

    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'nama_departemen' => 'required|string|max:100',
        ]);
        $department->update($request->only([
            'nama_departemen',
        ]));
        return redirect()->route('departments.index');
    }

    public function destroy(Department $department){
        $department->delete();
        return redirect()->route('departments.index');
    }
}