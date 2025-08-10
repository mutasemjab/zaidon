<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Expenses;
use App\Models\TypeExpenses;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Driver;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Expenses::with(['typeExpense', 'user', 'teacher', 'driver']);

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('amount', 'like', "%{$search}%")
                  ->orWhere('note', 'like', "%{$search}%")
                  ->orWhereHas('typeExpense', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('teacher', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('driver', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by expense type
        if ($request->has('type_expenses_id') && !empty($request->type_expenses_id)) {
            $query->where('type_expenses_id', $request->type_expenses_id);
        }

        // Filter by related person type
        if ($request->has('person_type') && !empty($request->person_type)) {
            switch ($request->person_type) {
                case 'user':
                    $query->whereNotNull('user_id');
                    break;
                case 'teacher':
                    $query->whereNotNull('teacher_id');
                    break;
                case 'driver':
                    $query->whereNotNull('driver_id');
                    break;
                case 'general':
                    $query->whereNull('user_id')
                          ->whereNull('teacher_id')
                          ->whereNull('driver_id');
                    break;
            }
        }

        // Filter by date range
        if ($request->has('date_from') && !empty($request->date_from)) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->has('date_to') && !empty($request->date_to)) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $expenses = $query->latest()->paginate(10);
        $typeExpenses = TypeExpenses::all();
        
        // Calculate totals
        $totalAmount = $query->sum('amount');
        $totalCount = $query->count();

        return view('admin.expenses.index', compact('expenses', 'typeExpenses', 'totalAmount', 'totalCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $typeExpenses = TypeExpenses::all();
        $users = User::where('activate', 1)->get();
        $teachers = Teacher::all();
        $drivers = Driver::all();
        
        return view('admin.expenses.create', compact('typeExpenses', 'users', 'teachers', 'drivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'note' => 'nullable|string',
            'type_expenses_id' => 'required|exists:type_expenses,id',
            'user_id' => 'nullable|exists:users,id',
            'teacher_id' => 'nullable|exists:teachers,id',
            'driver_id' => 'nullable|exists:drivers,id',
        ]);

        // Ensure only one person type is selected
        $personCount = collect([$request->user_id, $request->teacher_id, $request->driver_id])
            ->filter()
            ->count();
            
        if ($personCount > 1) {
            return back()->withErrors(['person' => __('messages.Please select only one person type')])->withInput();
        }

        Expenses::create([
            'amount' => $request->amount,
            'note' => $request->note,
            'type_expenses_id' => $request->type_expenses_id,
            'user_id' => $request->user_id,
            'teacher_id' => $request->teacher_id,
            'driver_id' => $request->driver_id,
        ]);

        return redirect()->route('expenses.index')
            ->with('success', __('messages.Expense created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Expenses $expense)
    {
        $expense->load(['typeExpense', 'user', 'teacher', 'driver']);
        return view('admin.expenses.show', compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expenses $expense)
    {
        $typeExpenses = TypeExpenses::all();
        $users = User::where('activate', 1)->get();
        $teachers = Teacher::all();
        $drivers = Driver::all();
        
        return view('admin.expenses.edit', compact('expense', 'typeExpenses', 'users', 'teachers', 'drivers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expenses $expense)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'note' => 'nullable|string',
            'type_expenses_id' => 'required|exists:type_expenses,id',
            'user_id' => 'nullable|exists:users,id',
            'teacher_id' => 'nullable|exists:teachers,id',
            'driver_id' => 'nullable|exists:drivers,id',
        ]);

        // Ensure only one person type is selected
        $personCount = collect([$request->user_id, $request->teacher_id, $request->driver_id])
            ->filter()
            ->count();
            
        if ($personCount > 1) {
            return back()->withErrors(['person' => __('messages.Please select only one person type')])->withInput();
        }

        $expense->update([
            'amount' => $request->amount,
            'note' => $request->note,
            'type_expenses_id' => $request->type_expenses_id,
            'user_id' => $request->user_id,
            'teacher_id' => $request->teacher_id,
            'driver_id' => $request->driver_id,
        ]);

        return redirect()->route('expenses.index')
            ->with('success', __('messages.Expense updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expenses $expense)
    {
        $expense->delete();

        return redirect()->route('expenses.index')
            ->with('success', __('messages.Expense deleted successfully'));
    }
}