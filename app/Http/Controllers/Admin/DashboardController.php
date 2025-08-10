<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Driver;
use App\Models\Expense;
use App\Models\Expenses;
use App\Models\StudentPayment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get total counts
        $totalStudents = User::where('activate', 1)->count();
        $totalTeachers = Teacher::count();
        $totalDrivers = Driver::count();
        
        // Get financial data
        $totalExpenses = Expenses::sum('amount');
        $totalPayments = StudentPayment::sum('amount_paid');
        $totalOutstanding = User::where('activate', 1)->sum('past_balance');
        
        // Get monthly data for current year
        $monthlyPayments = StudentPayment::select(
            DB::raw('MONTH(payment_date) as month'),
            DB::raw('SUM(amount_paid) as total')
        )
        ->whereYear('payment_date', Carbon::now()->year)
        ->groupBy('month')
        ->pluck('total', 'month')
        ->toArray();
        
        $monthlyExpenses = Expenses::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(amount) as total')
        )
        ->whereYear('created_at', Carbon::now()->year)
        ->groupBy('month')
        ->pluck('total', 'month')
        ->toArray();
        
        // Prepare monthly data for charts (12 months)
        $monthlyData = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthlyData[] = [
                'month' => Carbon::create()->month($i)->format('M'),
                'payments' => $monthlyPayments[$i] ?? 0,
                'expenses' => $monthlyExpenses[$i] ?? 0,
            ];
        }
        
        // Recent activities
        $recentPayments = StudentPayment::with('student')
            ->latest()
            ->take(5)
            ->get();
            
        $recentExpenses = Expenses::with(['typeExpense', 'user', 'teacher', 'driver'])
            ->latest()
            ->take(5)
            ->get();
        
        // Active vs inactive students
        $activeStudents = User::where('activate', 1)->count();
        $inactiveStudents = User::where('activate', 2)->count();
        
        return view('admin.dashboard', compact(
            'totalStudents',
            'totalTeachers', 
            'totalDrivers',
            'totalExpenses',
            'totalPayments',
            'totalOutstanding',
            'monthlyData',
            'recentPayments',
            'recentExpenses',
            'activeStudents',
            'inactiveStudents'
        ));
    }

}
