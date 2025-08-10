<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Clas;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::with('clas');

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

        // Filter by class
        if ($request->has('clas_id') && !empty($request->clas_id)) {
            $query->where('clas_id', $request->clas_id);
        }

        // Filter by activation status
        if ($request->has('activate') && $request->activate !== '') {
            $query->where('activate', $request->activate);
        }

        $users = $query->latest()->paginate(10);
        $classes = Clas::all();

        return view('admin.users.index', compact('users', 'classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Clas::all();
        return view('admin.users.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:users,phone',
            'identity_number' => 'nullable|string|unique:users,identity_number',
            'address' => 'nullable|string|max:500',
            'name_of_parent' => 'nullable|string|max:255',
            'phone_of_parent' => 'nullable|string|max:20',
            'annual_installment' => 'required|numeric|min:0',
            'past_balance' => 'nullable|numeric|min:0',
            'activate' => 'required|in:1,2',
            'clas_id' => 'nullable|exists:clas,id',
        ]);

        User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'identity_number' => $request->identity_number,
            'address' => $request->address,
            'name_of_parent' => $request->name_of_parent,
            'phone_of_parent' => $request->phone_of_parent,
            'annual_installment' => $request->annual_installment,
            'past_balance' => $request->past_balance ?? 0,
            'activate' => $request->activate,
            'clas_id' => $request->clas_id,
        ]);

        return redirect()->route('users.index')
            ->with('success', __('messages.User created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load('clas');
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $classes = Clas::all();
        return view('admin.users.edit', compact('user', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:users,phone,' . $user->id,
            'identity_number' => 'nullable|string|unique:users,identity_number,' . $user->id,
            'address' => 'nullable|string|max:500',
            'name_of_parent' => 'nullable|string|max:255',
            'phone_of_parent' => 'nullable|string|max:20',
            'annual_installment' => 'required|numeric|min:0',
            'past_balance' => 'nullable|numeric|min:0',
            'activate' => 'required|in:1,2',
            'clas_id' => 'nullable|exists:clas,id',
        ]);

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'identity_number' => $request->identity_number,
            'address' => $request->address,
            'name_of_parent' => $request->name_of_parent,
            'phone_of_parent' => $request->phone_of_parent,
            'annual_installment' => $request->annual_installment,
            'past_balance' => $request->past_balance ?? 0,
            'activate' => $request->activate,
            'clas_id' => $request->clas_id,
        ]);

        return redirect()->route('users.index')
            ->with('success', __('messages.User updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', __('messages.User deleted successfully'));
    }

    /**
     * Toggle user activation status
     */
    public function toggleActivation(User $user)
    {
        $user->update([
            'activate' => $user->activate == 1 ? 2 : 1
        ]);

        $status = $user->activate == 1 ? __('messages.activated') : __('messages.deactivated');
        
        return redirect()->back()
            ->with('success', __('messages.User') . ' ' . $status . ' ' . __('messages.successfully'));
    }
}