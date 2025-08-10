<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\TypeExpenses;
use Illuminate\Http\Request;

class TypeExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TypeExpenses::withCount('expenses');

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        $typeExpenses = $query->latest()->paginate(10);

        return view('admin.type-expenses.index', compact('typeExpenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.type-expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:type_expenses,name',
        ]);

        TypeExpenses::create([
            'name' => $request->name,
        ]);

        return redirect()->route('type-expenses.index')
            ->with('success', __('messages.Expense type created successfully'));
    }

   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypeExpenses $typeExpense)
    {
        return view('admin.type-expenses.edit', compact('typeExpense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TypeExpenses $typeExpense)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:type_expenses,name,' . $typeExpense->id,
        ]);

        $typeExpense->update([
            'name' => $request->name,
        ]);

        return redirect()->route('type-expenses.index')
            ->with('success', __('messages.Expense type updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeExpenses $typeExpense)
    {
        $typeExpense->delete();

        return redirect()->route('type-expenses.index')
            ->with('success', __('messages.Expense type deleted successfully'));
    }
}