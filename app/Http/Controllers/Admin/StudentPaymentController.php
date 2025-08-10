<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\StudentPayment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentPaymentController extends Controller
{
    /**
     * Display a listing of the student payments.
     */
    public function index(Request $request)
    {
        $query = StudentPayment::with(['student', 'admin']);

        // Filter by student if provided
        if ($request->has('student_id') && $request->student_id) {
            $query->where('user_id', $request->student_id);
        }

        // Filter by date range if provided
        if ($request->has('date_from') && $request->date_from) {
            $query->where('payment_date', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->where('payment_date', '<=', $request->date_to);
        }

        $payments = $query->orderBy('payment_date', 'desc')->paginate(15);
        $students = User::get(); // Assuming you have a role field

        return view('admin.student_payments.index', compact('payments', 'students'));
    }

    /**
     * Show the form for creating a new student payment.
     */
    public function create()
    {
        $students = User::get(); // Adjust based on your user structure
        return view('admin.student_payments.create', compact('students'));
    }

    /**
     * Store a newly created student payment in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount_paid' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'note' => 'nullable|string|max:1000',
        ]);

        StudentPayment::create([
            'user_id' => $request->user_id,
            'amount_paid' => $request->amount_paid,
            'payment_date' => $request->payment_date,
            'receipt_number' => $this->generateReceiptNumber(),
            'note' => $request->note,
            'admin_id' => Auth::guard('admin')->id(), // Assuming admin guard
        ]);

        return redirect()->route('student-payments.index')
            ->with('success', __('messages.Payment recorded successfully'));
    }

    /**
     * Display the specified student payment.
     */
    public function show(StudentPayment $studentPayment)
    {
        $studentPayment->load(['student', 'admin']);
        return view('admin.student_payments.show', compact('studentPayment'));
    }

    /**
     * Show the form for editing the specified student payment.
     */
    public function edit(StudentPayment $studentPayment)
    {
        $students = User::get();
        return view('admin.student_payments.edit', compact('studentPayment', 'students'));
    }

    /**
     * Update the specified student payment in storage.
     */
    public function update(Request $request, StudentPayment $studentPayment)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount_paid' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'note' => 'nullable|string|max:1000',
        ]);

        $studentPayment->update([
            'user_id' => $request->user_id,
            'amount_paid' => $request->amount_paid,
            'payment_date' => $request->payment_date,
            'note' => $request->note,
        ]);

        return redirect()->route('student-payments.index')
            ->with('success', __('messages.Payment updated successfully'));
    }

    /**
     * Remove the specified student payment from storage.
     */
    public function destroy(StudentPayment $studentPayment)
    {
        $studentPayment->delete();

        return redirect()->route('student-payments.index')
            ->with('success', __('messages.Payment deleted successfully'));
    }

    /**
     * Generate a unique receipt number.
     */
    private function generateReceiptNumber()
    {
        do {
            $receiptNumber = 'RCP-' . date('Y') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        } while (StudentPayment::where('receipt_number', $receiptNumber)->exists());

        return $receiptNumber;
    }

    /**
     * Print receipt for a payment.
     */
    public function printReceipt(StudentPayment $studentPayment)
    {
        $studentPayment->load(['student', 'admin']);
        return view('admin.student_payments.receipt', compact('studentPayment'));
    }
}