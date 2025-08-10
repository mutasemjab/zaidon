<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Driver::query();

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

        $drivers = $query->latest()->paginate(10);

        return view('admin.drivers.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:drivers,phone',
            'identity_number' => 'nullable|string|unique:drivers,identity_number',
            'address' => 'nullable|string|max:500',
            'salary' => 'nullable|numeric|min:0',
            'note' => 'nullable|string',
        ]);

        Driver::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'identity_number' => $request->identity_number,
            'address' => $request->address,
            'salary' => $request->salary,
            'note' => $request->note,
        ]);

        return redirect()->route('drivers.index')
            ->with('success', __('messages.Driver created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        return view('admin.drivers.show', compact('driver'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Driver $driver)
    {
        return view('admin.drivers.edit', compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:drivers,phone,' . $driver->id,
            'identity_number' => 'nullable|string|unique:drivers,identity_number,' . $driver->id,
            'address' => 'nullable|string|max:500',
            'salary' => 'nullable|numeric|min:0',
            'note' => 'nullable|string',
        ]);

        $driver->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'identity_number' => $request->identity_number,
            'address' => $request->address,
            'salary' => $request->salary,
            'note' => $request->note,
        ]);

        return redirect()->route('drivers.index')
            ->with('success', __('messages.Driver updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        $driver->delete();

        return redirect()->route('drivers.index')
            ->with('success', __('messages.Driver deleted successfully'));
    }
}