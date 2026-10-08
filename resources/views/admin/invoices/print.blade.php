<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Invoice') }} #{{ $invoice->invoice_number }} — {{ config('app.name', 'SmartERP') }}</title>

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

        .document-container {
            max-width: 900px;
            margin: 0 auto;
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            padding: 3rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #0ea5e9;
            padding-bottom: 1.5rem;
            margin-bottom: 2rem;
        }

        .brand h1 {
            font-size: 1.5rem;
            color: #0ea5e9;
            font-weight: 800;
        }

        .doc-title {
            text-align: end;
        }

        .doc-title h2 {
            font-size: 1.6rem;
            color: #0f172a;
        }

        .status-tag {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 99px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            background: #dcfce7;
            color: #15803d;
            margin-top: 0.5rem;
        }

        .meta-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            background: #f8fafc;
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
        }

        .meta-item strong {
            display: block;
            font-size: 0.75rem;
            color: #64748b;
            text-transform: uppercase;
        }

        .meta-item span {
            font-size: 1rem;
            font-weight: 700;
            color: #0f172a;
        }

        .financial-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }

        .financial-table th, .financial-table td {
            padding: 0.85rem 1rem;
            text-align: start;
            border-bottom: 1px solid #e2e8f0;
        }

        .financial-table th {
            background: #f8fafc;
            font-size: 0.75rem;
            text-transform: uppercase;
            color: #64748b;
        }

        .totals-block {
            max-width: 320px;
            margin-inline-start: auto;
            background: #f8fafc;
            padding: 1.25rem;
            border-radius: 12px;
            margin-bottom: 3rem;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 0.4rem 0;
            font-size: 0.9rem;
        }

        .total-row.grand {
            font-size: 1.2rem;
            font-weight: 800;
            color: #0ea5e9;
            border-top: 2px dashed #cbd5e1;
            margin-top: 0.5rem;
            padding-top: 0.75rem;
        }

        .signatures {
            display: flex;
            justify-content: space-between;
            padding-top: 2rem;
            border-top: 1px solid #e2e8f0;
        }

        .sig-box {
            width: 45%;
            text-align: center;
        }

        .sig-line {
            height: 60px;
            border-bottom: 1.5px dashed #cbd5e1;
            margin-bottom: 0.5rem;
        }

        @media print {
            .no-print-bar { display: none !important; }
            body { padding: 0; }
            .document-container { border: none; box-shadow: none; padding: 0; }
        }
    </style>
</head>
<body>

    <div class="no-print-bar">
        <div>
            <strong>{{ __('Official Invoice Printable View') }}</strong>
            <span style="color: #64748b; font-size: 0.85rem; margin-inline-start: 0.5rem;">
                {{ __('Use the button to print or save as PDF.') }}
            </span>
        </div>
        <button onclick="window.print()" class="btn-print">
            <i class="fas fa-print"></i>
            {{ __('Print / Save PDF') }}
        </button>
    </div>

    <div class="document-container">
        <div class="header">
            <div class="brand">
                <h1><i class="fas fa-building-columns"></i> {{ config('app.name', 'SmartERP') }}</h1>
                <p style="color: #64748b; font-size: 0.8rem; margin-top: 0.2rem;">Official Financial Invoice</p>
            </div>
            <div class="doc-title">
                <h2>{{ __('INVOICE') }}</h2>
                <div class="status-tag">{{ $invoice->status }}</div>
            </div>
        </div>

        <div class="meta-grid">
            <div class="meta-item">
                <strong>{{ __('Invoice Number') }}</strong>
                <span>{{ $invoice->invoice_number }}</span>
            </div>
            <div class="meta-item">
                <strong>{{ __('Vendor / Client') }}</strong>
                <span>{{ $invoice->vendor }}</span>
            </div>
            <div class="meta-item">
                <strong>{{ __('Invoice Date') }}</strong>
                <span>{{ optional($invoice->invoice_date)->format('Y-m-d') ?? '-' }}</span>
            </div>
            <div class="meta-item">
                <strong>{{ __('Due Date') }}</strong>
                <span>{{ optional($invoice->due_date)->format('Y-m-d') ?? '-' }}</span>
            </div>
        </div>

        <table class="financial-table">
            <thead>
                <tr>
                    <th>{{ __('Description / Title') }}</th>
                    <th>{{ __('Project') }}</th>
                    <th style="text-align: end;">{{ __('Subtotal') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>{{ $invoice->title }}</strong>
                        @if($invoice->description)
                            <br><small style="color: #64748b;">{{ $invoice->description }}</small>
                        @endif
                    </td>
                    <td>{{ $invoice->project?->name ?? __('N/A') }}</td>
                    <td style="text-align: end; font-weight: 700;">₪ {{ number_format($invoice->subtotal, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="totals-block">
            <div class="total-row">
                <span>{{ __('Subtotal') }}:</span>
                <strong>₪ {{ number_format($invoice->subtotal, 2) }}</strong>
            </div>
            <div class="total-row">
                <span>{{ __('Tax Amount') }}:</span>
                <strong>₪ {{ number_format($invoice->tax_amount, 2) }}</strong>
            </div>
            <div class="total-row grand">
                <span>{{ __('Total') }}:</span>
                <span>₪ {{ number_format($invoice->total_amount, 2) }}</span>
            </div>
            <div class="total-row" style="color: #059669; font-weight: 700; margin-top: 0.5rem;">
                <span>{{ __('Paid Amount') }}:</span>
                <span>₪ {{ number_format($invoice->paid_amount, 2) }}</span>
            </div>
            <div class="total-row" style="color: #dc2626; font-weight: 700;">
                <span>{{ __('Balance Due') }}:</span>
                <span>₪ {{ number_format($invoice->balance_amount, 2) }}</span>
            </div>
        </div>

        <div class="signatures">
            <div class="sig-box">
                <div class="sig-line"></div>
                <strong>{{ __('Finance Approval') }}</strong>
                <p style="font-size: 0.8rem; color: #64748b;">{{ config('app.name', 'SmartERP') }}</p>
            </div>
            <div class="sig-box">
                <div class="sig-line"></div>
                <strong>{{ __('Client / Recipient Confirmation') }}</strong>
            </div>
        </div>
    </div>

</body>
</html>
