@extends('layouts.admin')

@section('title', __('messages.Student Payments'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">{{ __('messages.Student Payments') }}</h3>
                    <a href="{{ route('student-payments.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('messages.Add New Payment') }}
                    </a>
                </div>

                <!-- Filters -->
                <div class="card-body">
                    <form method="GET" action="{{ route('student-payments.index') }}" class="mb-3">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label for="student_id" class="form-label">{{ __('messages.Student') }}</label>
                                <select name="student_id" id="student_id" class="form-select">
                                    <option value="">{{ __('messages.All Students') }}</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}" 
                                            {{ request('student_id') == $student->id ? 'selected' : '' }}>
                                            {{ $student->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="date_from" class="form-label">{{ __('messages.From Date') }}</label>
                                <input type="date" name="date_from" id="date_from" 
                                    class="form-control" value="{{ request('date_from') }}">
                            </div>
                            <div class="col-md-3">
                                <label for="date_to" class="form-label">{{ __('messages.To Date') }}</label>
                                <input type="date" name="date_to" id="date_to" 
                                    class="form-control" value="{{ request('date_to') }}">
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-outline-primary me-2">
                                    <i class="fas fa-search"></i> {{ __('messages.Filter') }}
                                </button>
                                <a href="{{ route('student-payments.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i> {{ __('messages.Clear') }}
                                </a>
                            </div>
                        </div>
                    </form>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Payments Table -->
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{ __('messages.Receipt Number') }}</th>
                                    <th>{{ __('messages.Student') }}</th>
                                    <th>{{ __('messages.Amount Paid') }}</th>
                                    <th>{{ __('messages.Payment Date') }}</th>
                                    <th>{{ __('messages.Note') }}</th>
                                    <th>{{ __('messages.Recorded By') }}</th>
                                    <th>{{ __('messages.Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($payments as $payment)
                                    <tr>
                                        <td>
                                            <strong class="text-primary">{{ $payment->receipt_number }}</strong>
                                        </td>
                                        <td>
                                            <div class="fw-bold">{{ $payment->student->name }}</div>
                                            <small class="text-muted">{{ $payment->student->email }}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-success fs-6">
                                                ${{ number_format($payment->amount_paid, 2) }}
                                            </span>
                                        </td>
                                        <td>{{ $payment->payment_date->format('Y-m-d') }}</td>
                                        <td>
                                            @if($payment->note)
                                                <span class="text-truncate d-inline-block" style="max-width: 150px;" 
                                                    title="{{ $payment->note }}">
                                                    {{ $payment->note }}
                                                </span>
                                            @else
                                                <span class="text-muted">{{ __('messages.No Note') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($payment->admin)
                                                {{ $payment->admin->name }}
                                            @else
                                                <span class="text-muted">{{ __('messages.System') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('student-payments.show', $payment) }}" 
                                                    class="btn btn-sm btn-outline-info" title="{{ __('messages.View') }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('student-payments.print-receipt', $payment) }}" 
                                                    class="btn btn-sm btn-outline-secondary" target="_blank" 
                                                    title="{{ __('messages.Print Receipt') }}">
                                                    <i class="fas fa-print"></i>
                                                </a>
                                                <a href="{{ route('student-payments.edit', $payment) }}" 
                                                    class="btn btn-sm btn-outline-warning" title="{{ __('messages.Edit') }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('student-payments.destroy', $payment) }}" 
                                                    method="POST" class="d-inline" 
                                                    onsubmit="return confirm('{{ __('messages.Are you sure you want to delete this payment?') }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                        title="{{ __('messages.Delete') }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-inbox fa-3x mb-3"></i>
                                                <p>{{ __('messages.No payments found') }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $payments->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection