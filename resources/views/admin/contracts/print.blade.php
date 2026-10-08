<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Contract') }} #{{ $contract->contract_number }} — {{ config('app.name', 'SmartERP') }}</title>

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
            background: #e0f2fe;
            color: #0369a1;
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

        .section-title {
            font-size: 1.1rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: #0f172a;
            border-inline-start: 4px solid #0ea5e9;
            padding-inline-start: 0.75rem;
        }

        .details-content {
            font-size: 0.95rem;
            color: #334155;
            margin-bottom: 2.5rem;
            white-space: pre-line;
        }

        .signatures {
            margin-top: 4rem;
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
            <strong>{{ __('Official Printable View') }}</strong>
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
                <p style="color: #64748b; font-size: 0.8rem; margin-top: 0.2rem;">Contract & Financial Management</p>
            </div>
            <div class="doc-title">
                <h2>{{ __('CONTRACT DOCUMENT') }}</h2>
                <div class="status-tag">{{ $contract->status }}</div>
            </div>
        </div>

        <div class="meta-grid">
            <div class="meta-item">
                <strong>{{ __('Contract Number') }}</strong>
                <span>{{ $contract->contract_number }}</span>
            </div>
            <div class="meta-item">
                <strong>{{ __('Contract Title') }}</strong>
                <span>{{ $contract->title }}</span>
            </div>
            <div class="meta-item">
                <strong>{{ __('Party Name') }} ({{ $contract->party_type }})</strong>
                <span>{{ $contract->party_name }}</span>
            </div>
            <div class="meta-item">
                <strong>{{ __('Contract Value') }}</strong>
                <span>₪ {{ number_format($contract->contract_value, 2) }}</span>
            </div>
            <div class="meta-item">
                <strong>{{ __('Start Date') }}</strong>
                <span>{{ optional($contract->start_date)->format('Y-m-d') ?? '-' }}</span>
            </div>
            <div class="meta-item">
                <strong>{{ __('End Date') }}</strong>
                <span>{{ optional($contract->end_date)->format('Y-m-d') ?? '-' }}</span>
            </div>
        </div>

        <div class="section-title">{{ __('Project Information') }}</div>
        <div class="details-content">
            <strong>{{ __('Project') }}:</strong> {{ $contract->project?->name ?? __('N/A') }}
        </div>

        @if($contract->description)
            <div class="section-title">{{ __('Contract Description / Terms') }}</div>
            <div class="details-content">
                {{ $contract->description }}
            </div>
        @endif

        <div class="signatures">
            <div class="sig-box">
                <div class="sig-line"></div>
                <strong>{{ __('Authorized Signature') }}</strong>
                <p style="font-size: 0.8rem; color: #64748b;">{{ config('app.name', 'SmartERP') }}</p>
            </div>
            <div class="sig-box">
                <div class="sig-line"></div>
                <strong>{{ __('Second Party Signature') }}</strong>
                <p style="font-size: 0.8rem; color: #64748b;">{{ $contract->party_name }}</p>
            </div>
        </div>
    </div>

</body>
</html>
