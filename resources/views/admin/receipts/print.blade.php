<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Receipt') }} #{{ $receipt->receipt_number }} — {{ config('app.name', 'SmartERP') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Outfit', 'IBM Plex Sans Arabic', sans-serif;
            background: var(--card);
            color: #1e293b;
            padding: 2.5rem;
            line-height: 1.6;
        }

        .no-print-bar {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .btn-print {
            background: #0ea5e9;
            color: #fff;
            border: none;
            padding: 0.6rem 1.4rem;
            border-radius: 99px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
        }

        .receipt-card {
            max-width: 750px;
            margin: 0 auto;
            border: 2px solid #0ea5e9;
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 10px 30px rgba(14, 165, 233, 0.05);
            background: var(--card);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px dashed #cbd5e1;
            padding-bottom: 1.5rem;
            margin-bottom: 1.75rem;
        }

        .brand h1 {
            font-size: 1.4rem;
            color: #0ea5e9;
            font-weight: 800;
        }

        .receipt-number-badge {
            background: #0ea5e9;
            color: #fff;
            padding: 0.4rem 1rem;
            border-radius: 99px;
            font-weight: 800;
            font-size: 0.95rem;
        }

        .amount-box {
            background: #f0fdf4;
            border: 1.5px solid #86efac;
            padding: 1.25rem;
            border-radius: 12px;
            text-align: center;
            margin-bottom: 2rem;
        }

        .amount-box label {
            font-size: 0.75rem;
            color: #166534;
            text-transform: uppercase;
            font-weight: 700;
            display: block;
        }

        .amount-box .val {
            font-size: 2.2rem;
            font-weight: 800;
            color: #15803d;
        }

        .details-grid {
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
            margin-bottom: 2.5rem;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding-bottom: 0.6rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .detail-row label {
            color: #64748b;
            font-weight: 600;
        }

        .detail-row span {
            font-weight: 700;
            color: #0f172a;
        }

        .signatures {
            display: flex;
            justify-content: space-between;
            padding-top: 2rem;
            border-top: 2px dashed #cbd5e1;
        }

        .sig-box {
            width: 45%;
            text-align: center;
        }

        .sig-line {
            height: 50px;
            border-bottom: 1.5px solid #94a3b8;
            margin-bottom: 0.5rem;
        }

        @media print {
            .no-print-bar { display: none !important; }
            body { padding: 0; }
            .receipt-card { border: 1px solid #000; box-shadow: none; padding: 1.5rem; }
        }
    </style>
</head>
<body>

    <div class="no-print-bar">
        <div>
            <strong>{{ __('Official Payment Receipt') }}</strong>
            <span style="color: #64748b; font-size: 0.85rem; margin-inline-start: 0.5rem;">
                {{ __('Use the button to print or save as PDF.') }}
            </span>
        </div>
        <button onclick="window.print()" class="btn-print">
            <i class="fas fa-print"></i>
            {{ __('Print Receipt / PDF') }}
        </button>
    </div>

    <div class="receipt-card">
        <div class="header">
            <div class="brand">
                <h1><i class="fas fa-receipt me-2"></i> {{ config('app.name', 'SmartERP') }}</h1>
                <p style="color: #64748b; font-size: 0.8rem;">Official Payment Voucher / Receipt</p>
            </div>
            <div class="receipt-number-badge">
                {{ $receipt->receipt_number }}
            </div>
        </div>

        <div class="amount-box">
            <label>{{ __('Amount Received / Paid') }}</label>
            <div class="val">₪ {{ number_format($receipt->amount, 2) }}</div>
        </div>

        <div class="details-grid">
            <div class="detail-row">
                <label>{{ __('Receipt Date') }}:</label>
                <span>{{ optional($receipt->receipt_date)->format('Y-m-d') ?? '-' }}</span>
            </div>
            <div class="detail-row">
                <label>{{ __('Payment Reference') }}:</label>
                <span>{{ $receipt->payment?->payment_number ?? __('N/A') }}</span>
            </div>
            <div class="detail-row">
                <label>{{ __('Payment Method') }}:</label>
                <span>{{ strtoupper($receipt->payment?->payment_method ?? 'N/A') }}</span>
            </div>
            <div class="detail-row">
                <label>{{ __('Issued By') }}:</label>
                <span>{{ $receipt->issuer?->name ?? __('System') }}</span>
            </div>
            @if($receipt->description)
                <div class="detail-row">
                    <label>{{ __('Description / Notes') }}:</label>
                    <span>{{ $receipt->description }}</span>
                </div>
            @endif
        </div>

        <div class="signatures">
            <div class="sig-box">
                <div class="sig-line"></div>
                <strong>{{ __('Cashier / Accountant Signature') }}</strong>
            </div>
            <div class="sig-box">
                <div class="sig-line"></div>
                <strong>{{ __('Recipient Signature') }}</strong>
            </div>
        </div>
    </div>

</body>
</html>
