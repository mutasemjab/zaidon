<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.Payment Receipt') }} - {{ $studentPayment->receipt_number }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none !important; }
            .page-break { page-break-before: always; }
        }
        
        .receipt-container {
            max-width: 600px;
            margin: 0 auto;
            border: 2px solid #dee2e6;
            border-radius: 10px;
            padding: 30px;
            margin-top: 20px;
            background: #fff;
        }
        
        .receipt-header {
            text-align: center;
            border-bottom: 2px solid #007bff;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .receipt-number {
            font-size: 1.5rem;
            font-weight: bold;
            color: #007bff;
            background: #e3f2fd;
            padding: 10px 20px;
            border-radius: 25px;
            display: inline-block;
            margin-top: 10px;
        }
        
        .amount-paid {
            font-size: 2rem;
            font-weight: bold;
            color: #28a745;
            text-align: center;
            background: #d4edda;
            padding: 15px;
            border-radius: 10px;
            margin: 20px 0;
        }
        
        .info-section {
            margin-bottom: 25px;
        }
        
        .info-label {
            font-weight: bold;
            color: #495057;
            margin-bottom: 5px;
        }
        
        .info-value {
            color: #212529;
            padding: 8px 12px;
            background: #f8f9fa;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        
        .footer-note {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
    </style>
</head>
<body>
    <!-- Print Button -->
    <button onclick="window.print()" class="btn btn-primary print-button no-print">
        <i class="fas fa-print"></i> {{ __('messages.Print') }}
    </button>

    <div class="receipt-container">
        <!-- Header -->
        <div class="receipt-header">
            <h2 class="mb-2">{{ __('messages.Payment Receipt') }}</h2>
            <p class="text-muted mb-0">{{ config('app.name', 'School Management System') }}</p>
            <div class="receipt-number">{{ $studentPayment->receipt_number }}</div>
        </div>

        <!-- Amount Paid -->
        <div class="amount-paid">
            ${{ number_format($studentPayment->amount_paid, 2) }}
        </div>

        <!-- Payment Information -->
        <div class="row">
            <div class="col-md-6">
                <div class="info-section">
                    <div class="info-label">{{ __('messages.Student Information') }}</div>
                    <div class="info-value">
                        <strong>{{ __('messages.Name') }}:</strong> {{ $studentPayment->student->name }}<br>
                        <strong>{{ __('messages.Email') }}:</strong> {{ $studentPayment->student->email }}
                        @if(isset($studentPayment->student->phone))
                            <br><strong>{{ __('messages.Phone') }}:</strong> {{ $studentPayment->student->phone }}
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-section">
                    <div class="info-label">{{ __('messages.Payment Details') }}</div>
                    <div class="info-value">
                        <strong>{{ __('messages.Payment Date') }}:</strong> {{ $studentPayment->payment_date->format('F d, Y') }}<br>
                        <strong>{{ __('messages.Created At') }}:</strong> {{ $studentPayment->created_at->format('F d, Y h:i A') }}
                    </div>
                </div>
            </div>
        </div>

        @if($studentPayment->note)
        <div class="info-section">
            <div class="info-label">{{ __('messages.Note') }}</div>
            <div class="info-value">{{ $studentPayment->note }}</div>
        </div>
        @endif

        <!-- Admin Information -->
        @if($studentPayment->admin)
        <div class="info-section">
            <div class="info-label">{{ __('messages.Recorded By') }}</div>
            <div class="info-value">
                <strong>{{ __('messages.Admin') }}:</strong> {{ $studentPayment->admin->name }}
                @if(isset($studentPayment->admin->email))
                    <br><strong>{{ __('messages.Email') }}:</strong> {{ $studentPayment->admin->email }}
                @endif
            </div>
        </div>
        @endif

        <!-- Summary Table -->
        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>{{ __('messages.Description') }}</th>
                        <th class="text-end">{{ __('messages.Amount') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            {{ __('messages.Payment') }}
                            @if($studentPayment->note)
                                <br><small class="text-muted">{{ $studentPayment->note }}</small>
                            @endif
                        </td>
                        <td class="text-end">
                            <strong>${{ number_format($studentPayment->amount_paid, 2) }}</strong>
                        </td>
                    </tr>
                </tbody>
                <tfoot class="table-success">
                    <tr>
                        <th>{{ __('messages.Total Paid') }}</th>
                        <th class="text-end">${{ number_format($studentPayment->amount_paid, 2) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer-note">
            <p class="mb-1">{{ __('messages.Thank you for your payment') }}</p>
            <p class="mb-0">{{ __('messages.Generated on') }}: {{ now()->format('F d, Y h:i A') }}</p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-kit-id.js" crossorigin="anonymous"></script>

    <script>
        // Auto print when page loads (optional)
        // window.onload = function() { window.print(); }
        
        // Close window after printing
        window.onafterprint = function() {
            // Uncomment if you want to close the window after printing
            // window.close();
        }
    </script>
</body>
</html>