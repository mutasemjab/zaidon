@extends('layouts.admin')

@section('title', __('messages.Edit Payment'))

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('messages.Edit Payment') }}</h3>
                    <div class="card-subtitle text-muted mt-1">
                        {{ __('messages.Receipt Number') }}: <strong>{{ $studentPayment->receipt_number }}</strong>
                    </div>
                </div>

                <form action="{{ route('student-payments.update', $studentPayment) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="user_id" class="form-label">{{ __('messages.Student') }} <span class="text-danger">*</span></label>
                                    <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                                        <option value="">{{ __('messages.Select Student') }}</option>
                                        @foreach($students as $student)
                                            <option value="{{ $student->id }}" 
                                                {{ (old('user_id', $studentPayment->user_id) == $student->id) ? 'selected' : '' }}>
                                                {{ $student->name }} - {{ $student->email }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="amount_paid" class="form-label">{{ __('messages.Amount Paid') }} <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" name="amount_paid" id="amount_paid" 
                                            class="form-control @error('amount_paid') is-invalid @enderror" 
                                            step="0.01" min="0" value="{{ old('amount_paid', $studentPayment->amount_paid) }}" required>
                                    </div>
                                    @error('amount_paid')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="payment_date" class="form-label">{{ __('messages.Payment Date') }} <span class="text-danger">*</span></label>
                                    <input type="date" name="payment_date" id="payment_date" 
                                        class="form-control @error('payment_date') is-invalid @enderror" 
                                        value="{{ old('payment_date', $studentPayment->payment_date->format('Y-m-d')) }}" required>
                                    @error('payment_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="note" class="form-label">{{ __('messages.Note') }}</label>
                                    <input type="text" name="note" id="note" 
                                        class="form-control @error('note') is-invalid @enderror" 
                                        value="{{ old('note', $studentPayment->note) }}" 
                                        placeholder="{{ __('messages.e.g., January installment') }}">
                                    @error('note')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i>
                                {{ __('messages.Receipt number cannot be changed after creation') }}: 
                                <strong>{{ $studentPayment->receipt_number }}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('student-payments.show', $studentPayment) }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> {{ __('messages.Back') }}
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> {{ __('messages.Update Payment') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auto-focus on amount input
    document.getElementById('amount_paid').focus();
    
    // Format amount input
    document.getElementById('amount_paid').addEventListener('input', function(e) {
        let value = parseFloat(e.target.value);
        if (!isNaN(value)) {
            e.target.setAttribute('title', 'Amount:  + value.toFixed(2));
        }
    });
</script>
@endpush
@endsection