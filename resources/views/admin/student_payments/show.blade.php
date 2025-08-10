@extends('layouts.admin')

@section('title', __('messages.Payment Details'))

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">{{ __('messages.Payment Details') }}</h3>
                    <div class="btn-group">
                        <a href="{{ route('student-payments.print-receipt', $studentPayment) }}" 
                            class="btn btn-outline-secondary" target="_blank">
                            <i class="fas fa-print"></i> {{ __('messages.Print Receipt') }}
                        </a>
                        <a href="{{ route('student-payments.edit', $studentPayment) }}" 
                            class="btn btn-outline-warning">
                            <i class="fas fa-edit"></i> {{ __('messages.Edit') }}
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h5 class="text-muted mb-2">{{ __('messages.Receipt Information') }}</h5>
                                <div class="border rounded p-3 bg-light">
                                    <div class="mb-2">
                                        <strong>{{ __('messages.Receipt Number') }}:</strong>
                                        <span class="badge bg-primary fs-6 ms-2">{{ $studentPayment->receipt_number }}</span>
                                    </div>
                                    <div class="mb-2">
                                        <strong>{{ __('messages.Payment Date') }}:</strong>
                                        <span class="ms-2">{{ $studentPayment->payment_date->format('F d, Y') }}</span>
                                    </div>
                                    <div>
                                        <strong>{{ __('messages.Amount Paid') }}:</strong>
                                        <span class="badge bg-success fs-5 ms-2">${{ number_format($studentPayment->amount_paid, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-4">
                                <h5 class="text-muted mb-2">{{ __('messages.Student Information') }}</h5>
                                <div class="border rounded p-3">
                                    <div class="mb-2">
                                        <strong>{{ __('messages.Name') }}:</strong>
                                        <span class="ms-2">{{ $studentPayment->student->name }}</span>
                                    </div>
                                    <div class="mb-2">
                                        <strong>{{ __('messages.Email') }}:</strong>
                                        <span class="ms-2">{{ $studentPayment->student->email }}</span>
                                    </div>
                                    @if(isset($studentPayment->student->phone))
                                    <div>
                                        <strong>{{ __('messages.Phone') }}:</strong>
                                        <span class="ms-2">{{ $studentPayment->student->phone }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($studentPayment->note)
                    <div class="mb-4">
                        <h5 class="text-muted mb-2">{{ __('messages.Note') }}</h5>
                        <div class="border rounded p-3 bg-light">
                            <p class="mb-0">{{ $studentPayment->note }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5 class="text-muted mb-2">{{ __('messages.Payment Details') }}</h5>
                                <div class="border rounded p-3">
                                    <div class="mb-2">
                                        <strong>{{ __('messages.Created At') }}:</strong>
                                        <span class="ms-2">{{ $studentPayment->created_at->format('F d, Y h:i A') }}</span>
                                    </div>
                                    @if($studentPayment->updated_at != $studentPayment->created_at)
                                    <div>
                                        <strong>{{ __('messages.Last Updated') }}:</strong>
                                        <span class="ms-2">{{ $studentPayment->updated_at->format('F d, Y h:i A') }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5 class="text-muted mb-2">{{ __('messages.Recorded By') }}</h5>
                                <div class="border rounded p-3">
                                    @if($studentPayment->admin)
                                        <div class="mb-2">
                                            <strong>{{ __('messages.Admin Name') }}:</strong>
                                            <span class="ms-2">{{ $studentPayment->admin->name }}</span>
                                        </div>
                                        @if(isset($studentPayment->admin->email))
                                        <div>
                                            <strong>{{ __('messages.Admin Email') }}:</strong>
                                            <span class="ms-2">{{ $studentPayment->admin->email }}</span>
                                        </div>
                                        @endif
                                    @else
                                        <div class="text-muted">
                                            <i class="fas fa-robot"></i> {{ __('messages.System Generated') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('student-payments.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> {{ __('messages.Back to Payments') }}
                        </a>
                        <div class="btn-group">
                            <a href="{{ route('student-payments.print-receipt', $studentPayment) }}" 
                                class="btn btn-outline-secondary" target="_blank">
                                <i class="fas fa-print"></i> {{ __('messages.Print Receipt') }}
                            </a>
                            <a href="{{ route('student-payments.edit', $studentPayment) }}" 
                                class="btn btn-warning">
                                <i class="fas fa-edit"></i> {{ __('messages.Edit Payment') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection