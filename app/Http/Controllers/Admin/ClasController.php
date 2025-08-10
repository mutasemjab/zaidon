<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Clas;
use Illuminate\Http\Request;

class ClasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clas = Clas::latest()->paginate(10);
        return view('admin.clas.index', compact('clas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.clas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:clas,name',
        ]);

        Clas::create([
            'name' => $request->name,
        ]);

        return redirect()->route('clas.index')
            ->with('success', __('messages.Class created successfully'));
    }

  

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clas $clas)
    {
        return view('admin.clas.edit', compact('clas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clas $clas)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:clas,name,' . $clas->id,
        ]);

        $clas->update([
            'name' => $request->name,
        ]);

        return redirect()->route('clas.index')
            ->with('success', __('messages.Class updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clas $clas)
    {
        $clas->delete();

        return redirect()->route('clas.index')
            ->with('success', __('messages.Class deleted successfully'));
    }
}