<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Teacher::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('identity_number', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }

        $teachers = $query->latest()->paginate(10);

        return view('admin.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:teachers,phone',
            'identity_number' => 'nullable|string|unique:teachers,identity_number',
            'address' => 'nullable|string|max:500',
            'salary' => 'nullable|numeric|min:0',
            'note' => 'nullable|string',
        ]);

        Teacher::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'identity_number' => $request->identity_number,
            'address' => $request->address,
            'salary' => $request->salary,
            'note' => $request->note,
        ]);

        return redirect()->route('teachers.index')
            ->with('success', __('messages.Teacher created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        return view('admin.teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:teachers,phone,' . $teacher->id,
            'identity_number' => 'nullable|string|unique:teachers,identity_number,' . $teacher->id,
            'address' => 'nullable|string|max:500',
            'salary' => 'nullable|numeric|min:0',
            'note' => 'nullable|string',
        ]);

        $teacher->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'identity_number' => $request->identity_number,
            'address' => $request->address,
            'salary' => $request->salary,
            'note' => $request->note,
        ]);

        return redirect()->route('teachers.index')
            ->with('success', __('messages.Teacher updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()->route('teachers.index')
            ->with('success', __('messages.Teacher deleted successfully'));
    }
}