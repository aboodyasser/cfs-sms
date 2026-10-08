@php
    $isRtl = app()->getLocale() === 'ar';
    $forwardIcon = $isRtl ? 'fa-arrow-left' : 'fa-arrow-right';
    $chevronIcon = $isRtl ? 'fa-chevron-left' : 'fa-chevron-right';
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">
<head><link rel="icon" type="image/jpeg" href="{{ asset('favicon.jpg') }}?v=2">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#F8FAFC">
    <title>{{ config('app.name', 'SmartERP') }} — {{ __('welcome.meta_title') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;500;600;700;800&family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --bg: #F8FAFC;
            --bg-2: #F1F5F9;
            --card: #FFFFFF;
            --card-hover: #F8FAFC;
            --glass: rgba(15, 23, 42, 0.035);

            --primary: #0EA5E9;
            --primary-dark: #0369A1;
            --secondary: #D946EF;
            --tertiary: #F59E0B;

            --text-1: #0F172A;
            --text-2: #475569;
            --text-3: #94A3B8;
            --line: rgba(15, 23, 42, 0.08);
            --line-strong: rgba(15, 23, 42, 0.14);

            --r-sm: 0.6rem; --r-md: 0.9rem; --r-lg: 1.25rem; --r-xl: 1.75rem; --r-full: 9999px;
            --ease: cubic-bezier(0.16, 1, 0.3, 1);
        }

    html.dark {
        --bg: #0F172A;
        --bg-2: #1E293B;
        --card: #1E293B;
        --card-hover: #334155;
        --glass: rgba(255, 255, 255, 0.035);
        --primary: #38BDF8;
        --primary-dark: #0284C7;
        --secondary: #E879F9;
        --tertiary: #FBBF24;
        --text: #F8FAFC;
        --text-1: #F8FAFC;
        --text-2: #CBD5E1;
        --text-3: #94A3B8;
        --line: rgba(255, 255, 255, 0.1);
        --line-strong: rgba(255, 255, 255, 0.18);
    }


        html { scroll-behavior: smooth; overflow-x: hidden; }

        body {
            font-family: 'Outfit', 'IBM Plex Sans Arabic', sans-serif;
            background: var(--bg);
            color: var(--text-1);
            line-height: 1.6;
            overflow-x: hidden;
            position: relative;
        }

        /* ---------- Animated grid background ---------- */
        .grid-bg {
            position: fixed; inset: 0; z-index: 0; pointer-events: none;
            background-image:
                linear-gradient(var(--line) 1px, transparent 1px),
                linear-gradient(90deg, var(--line) 1px, transparent 1px);
            background-size: 64px 64px;
            -webkit-mask-image: radial-gradient(ellipse 70% 55% at 50% 0%, black 0%, transparent 75%);
            mask-image: radial-gradient(ellipse 70% 55% at 50% 0%, black 0%, transparent 75%);
            opacity: 0.7;
        }

        .noise-orb {
            position: fixed; z-index: 0; pointer-events: none; border-radius: 50%; filter: blur(70px);
            animation: drift 16s ease-in-out infinite;
        }
        .orb-1 { top: -10%; inset-inline-start: -8%; width: 520px; height: 520px; background: radial-gradient(circle, rgba(14,165,233,0.22) 0%, transparent 70%); }
        .orb-2 { top: 10%; inset-inline-end: -10%; width: 460px; height: 460px; background: radial-gradient(circle, rgba(217,70,239,0.15) 0%, transparent 70%); animation-delay: -6s; }
        .orb-3 { bottom: -15%; inset-inline-start: 30%; width: 500px; height: 500px; background: radial-gradient(circle, rgba(245,158,11,0.12) 0%, transparent 70%); animation-delay: -11s; }
        @keyframes drift {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, -30px) scale(1.1); }
        }

        .container { width: 100%; max-width: 1360px; margin: 0 auto; padding: 0 1.5rem; position: relative; z-index: 1; }

        /* ---------- Reveal ---------- */
        .reveal { opacity: 0; transform: translateY(26px); transition: opacity 0.8s var(--ease), transform 0.8s var(--ease); }
        .reveal.is-visible { opacity: 1; transform: translateY(0); }
        .r-1 { transition-delay: .08s; } .r-2 { transition-delay: .16s; }
        .r-3 { transition-delay: .24s; } .r-4 { transition-delay: .32s; }

        /* ---------- Floating glass navbar ---------- */
        .nav-wrap { position: sticky; top: 0; z-index: 50; padding: 1.25rem 1.5rem 0; }
        .nav-pill {
            max-width: 1200px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between;
            gap: 1.5rem; padding: 0.75rem 1rem 0.75rem 1.5rem; border-radius: var(--r-full);
            background: var(--glass); backdrop-filter: blur(20px) saturate(160%);
            border: 1px solid var(--line); box-shadow: 0 4px 24px rgba(15, 23, 42, 0.05);
            transition: all 0.4s var(--ease);
        }
        [dir="rtl"] .nav-pill { padding: 0.75rem 1.5rem 0.75rem 1rem; }
        .nav-wrap.is-scrolled .nav-pill { background: rgba(255, 255, 255, 0.92); border-color: var(--line-strong); box-shadow: 0 10px 34px rgba(15, 23, 42, 0.09); }

        .logo { display: flex; align-items: center; gap: 0.75rem; text-decoration: none; color: var(--text-1); }
        .logo-icon {
            width: 40px; height: 40px; border-radius: var(--r-md); display: flex; align-items: center; justify-content: center;
            font-size: 1.25rem; color: #fff; background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            box-shadow: 0 4px 18px rgba(14,165,233,0.4); transition: transform 0.4s var(--ease);
        }
        .logo:hover .logo-icon { transform: rotate(-10deg) scale(1.08); }
        .logo-text h1 { font-size: 1.05rem; font-weight: 700; letter-spacing: -0.01em; color: var(--text-1); }
        .logo-text p { font-size: 0.68rem; color: var(--text-2); }

        .lang-switch { display: flex; align-items: center; gap: 0.4rem; font-size: .85rem; font-weight: 600; }
        .lang-switch a { color: var(--text-3); text-decoration: none; transition: color 0.25s ease; }
        .lang-switch a.active { color: var(--primary); }
        .lang-switch a:hover { color: var(--text-1); }
        .lang-switch span { color: var(--line-strong); }

        .btn {
            display: inline-flex; align-items: center; justify-content: center; gap: 0.55rem;
            padding: 0.7rem 1.4rem; border-radius: var(--r-full); font-weight: 600; font-size: 0.88rem;
            border: none; cursor: pointer; transition: all 0.3s var(--ease); text-decoration: none; white-space: nowrap;
        }
        .btn-primary { background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: #fff; box-shadow: 0 6px 20px rgba(14,165,233,0.3); }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 12px 30px rgba(14,165,233,0.42); }
        .btn-secondary { background: var(--card); color: var(--text-1); border: 1.5px solid var(--line-strong); }
        .btn-secondary:hover { border-color: var(--primary); background: rgba(14,165,233,0.06); transform: translateY(-2px); }
        .btn-lg { padding: 0.95rem 2.1rem; font-size: 0.95rem; }

        /* ---------- Hero ---------- */
        .hero { position: relative; padding: 6rem 0 4rem; }
        .hero-spotlight {
            position: absolute; inset: 0; z-index: 0; pointer-events: none; opacity: 0; transition: opacity 0.4s ease;
            background: radial-gradient(600px circle at var(--mx, 50%) var(--my, 30%), rgba(14,165,233,0.10), transparent 60%);
        }
        .hero:hover .hero-spotlight { opacity: 1; }

        .hero-grid { position: relative; z-index: 1; display: grid; grid-template-columns: 1.05fr 0.95fr; gap: 3.5rem; align-items: center; }
        @media (max-width: 980px) { .hero-grid { grid-template-columns: 1fr; } }

        .hero-badge {
            display: inline-flex; align-items: center; gap: 0.55rem; padding: 0.45rem 1rem;
            background: var(--card); border: 1px solid var(--line-strong); border-radius: var(--r-full);
            font-size: .85rem; font-weight: 600; color: #0369A1; margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(15,23,42,0.04);
        }
        .hero-badge .dot { width: 7px; height: 7px; border-radius: 50%; background: var(--secondary); box-shadow: 0 0 0 3px rgba(217,70,239,0.18); animation: blink 2s ease-in-out infinite; }
        @keyframes blink { 0%, 100% { opacity: 1; } 50% { opacity: 0.4; } }

        .hero-title { font-size: clamp(2.3rem, 5vw, 4rem); font-weight: 800; line-height: 1.1; letter-spacing: -0.025em; margin-bottom: 1.4rem; color: var(--text-1); }
        .hero-title .gradient {
            background: linear-gradient(100deg, var(--primary) 0%, var(--secondary) 50%, var(--primary) 100%);
            background-size: 200% auto; -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
            animation: shine 6s linear infinite;
        }
        @keyframes shine { to { background-position: 200% center; } }

        .hero-desc { font-size: 1.05rem; color: var(--text-2); max-width: 560px; line-height: 1.85; margin-bottom: 2.25rem; }
        .hero-buttons { display: flex; gap: 1rem; flex-wrap: wrap; margin-bottom: 3rem; }

        .stats-row { display: flex; gap: 2.25rem; flex-wrap: wrap; }
        .stat-item { display: flex; flex-direction: column; }
        .stat-number { font-size: 1.9rem; font-weight: 800; color: var(--text-1); font-variant-numeric: tabular-nums; }
        .stat-label { font-size: 0.8rem; color: var(--text-3); }

        /* ---------- Hero visual mock ---------- */
        .hero-visual { position: relative; }
        .mock-panel {
            position: relative; border-radius: var(--r-xl); background: var(--card);
            border: 1px solid var(--line); padding: 1.75rem; box-shadow: 0 30px 70px rgba(15, 23, 42, 0.12);
            transform: perspective(1000px) rotateY(-6deg) rotateX(3deg);
            transition: transform 0.6s var(--ease);
        }
        [dir="rtl"] .mock-panel { transform: perspective(1000px) rotateY(6deg) rotateX(3deg); }
        .hero-visual:hover .mock-panel { transform: perspective(1000px) rotateY(0deg) rotateX(0deg); }

        .mock-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; }
        .mock-dots { display: flex; gap: 0.4rem; }
        .mock-dots span { width: 10px; height: 10px; border-radius: 50%; background: var(--line-strong); }
        .mock-badge { display: flex; align-items: center; gap: 0.4rem; font-size: 0.7rem; color: #059669; font-weight: 600; }
        .mock-badge .dot { width: 6px; height: 6px; border-radius: 50%; background: #059669; animation: blink 2s infinite; }

        .mock-kpis { display: grid; grid-template-columns: repeat(3, 1fr); gap: 0.75rem; margin-bottom: 1.25rem; }
        .mock-kpi { background: var(--bg); border: 1px solid var(--line); border-radius: var(--r-md); padding: 0.85rem; }
        .mock-kpi .bar { height: 5px; border-radius: 3px; background: linear-gradient(90deg, var(--primary), var(--secondary)); margin-bottom: 0.6rem; animation: growBar 2.2s var(--ease) infinite alternate; }
        .mock-kpi:nth-child(1) .bar { width: 70%; }
        .mock-kpi:nth-child(2) .bar { width: 45%; animation-delay: .2s; }
        .mock-kpi:nth-child(3) .bar { width: 88%; animation-delay: .4s; }
        @keyframes growBar { from { filter: brightness(0.9); } to { filter: brightness(1.15); } }
        .mock-kpi .num { font-size: 1.1rem; font-weight: 800; color: var(--text-1); }
        .mock-kpi .lbl { font-size: 0.65rem; color: var(--text-3); margin-top: 0.15rem; }

        .mock-chart { display: flex; align-items: flex-end; gap: 0.5rem; height: 90px; padding: 0.75rem; background: var(--bg); border: 1px solid var(--line); border-radius: var(--r-md); margin-bottom: 1rem; }
        .mock-chart .col { flex: 1; border-radius: 4px 4px 0 0; background: linear-gradient(180deg, var(--primary), rgba(14,165,233,0.15)); animation: rise 1.4s var(--ease) both; }
        .mock-chart .col:nth-child(2n) { background: linear-gradient(180deg, var(--secondary), rgba(217,70,239,0.15)); }
        @keyframes rise { from { transform: scaleY(0); transform-origin: bottom; } to { transform: scaleY(1); transform-origin: bottom; } }

        .mock-rows { display: flex; flex-direction: column; gap: 0.6rem; }
        .mock-row { display: flex; align-items: center; gap: 0.6rem; padding: 0.5rem 0.6rem; background: var(--bg); border: 1px solid var(--line); border-radius: var(--r-sm); }
        .mock-row i { color: #059669; font-size: 0.75rem; }
        .mock-row .line { flex: 1; height: 6px; border-radius: 3px; background: var(--line-strong); }
        .mock-row .line.short { max-width: 40%; }

        .float-chip {
            position: absolute; display: flex; align-items: center; gap: 0.5rem; padding: 0.6rem 0.9rem;
            background: var(--card); border: 1px solid var(--line-strong); border-radius: var(--r-full);
            font-size: 0.75rem; font-weight: 700; box-shadow: 0 12px 30px rgba(15,23,42,0.12);
            animation: floatChip 5s ease-in-out infinite;
        }
        .chip-1 { top: -1.25rem; inset-inline-start: -1.5rem; color: #059669; }
        .chip-2 { bottom: -1rem; inset-inline-end: -1rem; color: #B45309; animation-delay: -2.5s; }
        .float-chip i { font-size: 0.85rem; }
        @keyframes floatChip { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }

        /* ---------- Marquee ---------- */
        .marquee-section { padding: 2.5rem 0; border-block: 1px solid var(--line); overflow: hidden; }
        .marquee-track { display: flex; gap: 4rem; width: max-content; animation: scrollX 26s linear infinite; }
        [dir="rtl"] .marquee-track { animation-direction: reverse; }
        .marquee-track i { font-size: 1.6rem; color: var(--text-3); transition: color 0.3s ease; }
        .marquee-track i:hover { color: var(--primary); }
        @keyframes scrollX { from { transform: translateX(0); } to { transform: translateX(-50%); } }
        [dir="rtl"] .marquee-section .marquee-track { direction: ltr; }

        /* ---------- Features ---------- */
        .features { padding: 7rem 0; }
        .section-header { text-align: center; margin-bottom: 4rem; max-width: 620px; margin-inline: auto; }
        .section-badge {
            display: inline-flex; align-items: center; gap: 0.5rem; font-size: 0.72rem; font-weight: 700;
            letter-spacing: 0.08em; text-transform: uppercase; color: #059669; margin-bottom: 1rem;
        }
        .section-badge::before, .section-badge::after { content: ''; width: 24px; height: 1px; background: #059669; opacity: 0.4; }
        .section-title { font-size: clamp(1.9rem, 3.6vw, 2.6rem); font-weight: 800; letter-spacing: -0.02em; margin-bottom: 1rem; color: var(--text-1); }
        .section-subtitle { font-size: 1.02rem; color: var(--text-2); }

        .features-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; }

        .feature-card {
            --mx: 50%; --my: 50%;
            position: relative; padding: 1.75rem; border-radius: var(--r-lg); background: var(--card);
            border: 1px solid var(--line); overflow: hidden; transition: transform 0.35s var(--ease), border-color 0.35s ease, box-shadow 0.35s ease;
            box-shadow: 0 2px 10px rgba(15,23,42,0.04);
        }
        .feature-card::before {
            content: ''; position: absolute; inset: 0; border-radius: inherit; padding: 1px; opacity: 0;
            background: radial-gradient(320px circle at var(--mx) var(--my), var(--primary), transparent 70%);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor; mask-composite: exclude;
            transition: opacity 0.35s ease; pointer-events: none;
        }
        .feature-card:hover { transform: translateY(-6px); border-color: transparent; box-shadow: 0 20px 45px rgba(15,23,42,0.1); }
        .feature-card:hover::before { opacity: 1; }

        .feature-top { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 1.35rem; }
        .feature-icon {
            width: 50px; height: 50px; border-radius: var(--r-md); display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; color: var(--primary); background: rgba(14,165,233,0.1);
            transition: all 0.35s var(--ease);
        }
        .feature-card:hover .feature-icon { background: linear-gradient(135deg, var(--primary), var(--primary-dark)); color: #fff; transform: rotate(-6deg) scale(1.06); }
        .feature-num { font-size: 0.75rem; font-weight: 800; color: var(--text-3); font-variant-numeric: tabular-nums; }

        .feature-title { font-size: 1.12rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--text-1); }
        .feature-desc { font-size: 0.9rem; color: var(--text-2); line-height: 1.7; }

        /* ---------- CTA ---------- */
        .cta { padding: 6rem 0 7rem; }
        .cta-box {
            position: relative; max-width: 820px; margin: 0 auto; text-align: center; padding: 4rem 2.5rem;
            border-radius: var(--r-xl); overflow: hidden; background: var(--card); border: 1px solid var(--line);
            box-shadow: 0 20px 50px rgba(15,23,42,0.08);
        }
        .cta-box::before {
            content: ''; position: absolute; inset: -2px; border-radius: inherit; z-index: 0;
            background: conic-gradient(from 0deg, var(--primary), var(--secondary), var(--tertiary), var(--primary));
            opacity: 0.22; filter: blur(30px); animation: spin 10s linear infinite;
        }
        .cta-box > * { position: relative; z-index: 1; }
        @keyframes spin { to { transform: rotate(360deg); } }

        .cta-title { font-size: clamp(1.8rem, 3.4vw, 2.5rem); font-weight: 800; letter-spacing: -0.02em; margin-bottom: 1rem; color: var(--text-1); }
        .cta-desc { font-size: 1.02rem; color: var(--text-2); margin-bottom: 2.25rem; line-height: 1.8; }
        .cta-buttons { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }

        /* ---------- Footer ---------- */
        footer { padding: 3.5rem 0 2.5rem; border-top: 1px solid var(--line); position: relative; z-index: 1; }
        .footer-content { display: grid; grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)); gap: 2rem; margin-bottom: 2.5rem; }
        .footer-section h4 { font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem; font-size: 0.92rem; color: var(--text-1); }
        .footer-section h4 i { color: var(--primary); }
        .footer-section ul { list-style: none; }
        .footer-section li { margin-bottom: 0.65rem; }
        .footer-section a { color: var(--text-2); text-decoration: none; transition: color 0.25s ease; font-size: 0.88rem; }
        .footer-section a:hover { color: var(--primary); }
        .footer-bottom {
            border-top: 1px solid var(--line); padding-top: 1.75rem; display: flex; justify-content: space-between;
            align-items: center; color: var(--text-3); font-size: 0.82rem; flex-wrap: wrap; gap: 1.25rem;
        }
        .social-links { display: flex; gap: 1rem; }
        .social-links a {
            color: var(--text-2); text-decoration: none; width: 34px; height: 34px; border-radius: 50%;
            border: 1px solid var(--line); display: flex; align-items: center; justify-content: center; transition: all 0.25s ease;
        }
        .social-links a:hover { color: #fff; background: var(--primary); border-color: var(--primary); transform: translateY(-2px); }

        @media (max-width: 768px) {
            .nav-wrap { padding: 1rem 1rem 0; }
            .nav-pill { flex-wrap: wrap; border-radius: var(--r-lg); }
            .hero-buttons { flex-direction: column; }
            .btn-lg { width: 100%; }
            .footer-bottom { flex-direction: column; text-align: center; }
            .cta-box { padding: 2.75rem 1.5rem; }
            .mock-panel { transform: none !important; }
        }
    </style>
<script>
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
    function toggleTheme() {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.theme = 'light';
        } else {
            document.documentElement.classList.add('dark');
            localStorage.theme = 'dark';
        }
    }
</script>
</head>
<body>
    <div class="grid-bg"></div>
    <div class="noise-orb orb-1"></div>
    <div class="noise-orb orb-2"></div>
    <div class="noise-orb orb-3"></div>

    {{-- Navbar --}}
    <div class="nav-wrap" id="nav-wrap">
        <div class="nav-pill">
            <a href="{{ url('/') }}" class="logo">
                <div class="logo-icon"><i class="fas fa-layer-group"></i></div>
                <div class="logo-text">
                    <h1>{{ __('welcome.logo_name') }}</h1>
                    <p>{{ __('welcome.logo_tagline') }}</p>
                </div>
            </a>

            <div style="display:flex; align-items:center; gap: 1.25rem;">
                <button type="button" onclick="toggleTheme()" class="btn btn-secondary" style="padding: 0.5rem 0.75rem;" title="{{ __('Toggle Dark Mode') }}">
                    <i class="fas fa-circle-half-stroke"></i>
                </button>
                <div class="lang-switch">
                    <i class="fas fa-globe" style="color: var(--text-3); font-size: 13px; margin: 0 4px;"></i>
                    <a href="{{ route('lang.switch', 'ar') }}" class="{{ $isRtl ? 'active' : '' }}" style="font-family: 'IBM Plex Sans Arabic', sans-serif;">عربي</a>
                    <span>/</span>
                    <a href="{{ route('lang.switch', 'en') }}" class="{{ !$isRtl ? 'active' : '' }}">English</a>
                </div>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                            <i class="fas {{ $forwardIcon }}"></i>
                            {{ __('welcome.nav_dashboard') }}
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-right-to-bracket"></i>
                            {{ __('welcome.nav_login') }}
                        </a>
                    @endauth
                @endif
            </div>
        </div>
    </div>

    {{-- Hero --}}
    <section class="hero" id="hero">
        <div class="hero-spotlight" id="spotlight"></div>
        <div class="container">
            <div class="hero-grid">
                <div class="hero-text">
                    <div class="hero-badge reveal">
                        <span class="dot"></span>
                        {{ __('welcome.hero_badge') }}
                    </div>

                    <h1 class="hero-title reveal r-1">
                        {{ __('welcome.hero_title_line1') }}
                        <br>
                        <span class="gradient">{{ __('welcome.hero_title_gradient') }}</span>
                    </h1>

                    <p class="hero-desc reveal r-2">
                        <strong style="color: var(--text-1);">{{ config('app.name', 'Smart ERP') }}</strong> {{ __('welcome.hero_desc') }}
                    </p>

                    <div class="hero-buttons reveal r-3">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-gauge-high"></i>
                                {{ __('welcome.hero_cta_dashboard') }}
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-arrow-right-to-bracket"></i>
                                {{ __('welcome.hero_cta_login') }}
                            </a>
                        @endauth
                        <a href="#features" class="btn btn-secondary btn-lg">
                            <i class="fas {{ $chevronIcon }}"></i>
                            {{ __('welcome.hero_cta_explore') }}
                        </a>
                    </div>

                    <div class="stats-row reveal r-4">
                        @foreach ([1, 2, 3, 4] as $i)
                            <div class="stat-item">
                                <span class="stat-number" data-count="{{ __('welcome.stat_'.$i.'_number') }}">0</span>
                                <span class="stat-label">{{ __('welcome.stat_'.$i.'_label') }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="hero-visual reveal r-2">
                    <div class="float-chip chip-1"><i class="fas fa-shield-halved"></i> 100%</div>
                    <div class="float-chip chip-2"><i class="fas fa-bolt"></i> Live</div>

                    <div class="mock-panel">
                        <div class="mock-header">
                            <div class="mock-dots"><span></span><span></span><span></span></div>
                            <div class="mock-badge"><span class="dot"></span> {{ config('app.name', 'SmartERP') }}</div>
                        </div>

                        <div class="mock-kpis">
                            <div class="mock-kpi"><div class="bar"></div><div class="num">₪ 2.4M</div><div class="lbl">{{ __('welcome.footer_features_finance') }}</div></div>
                            <div class="mock-kpi"><div class="bar"></div><div class="num">128</div><div class="lbl">{{ __('welcome.footer_features_projects') }}</div></div>
                            <div class="mock-kpi"><div class="bar"></div><div class="num">98%</div><div class="lbl">{{ __('welcome.footer_features_reports') }}</div></div>
                        </div>

                        <div class="mock-chart">
                            @foreach ([40, 65, 50, 80, 60, 95, 70] as $i => $h)
                                <div class="col" style="height: {{ $h }}%; animation-delay: {{ $i * 0.08 }}s;"></div>
                            @endforeach
                        </div>

                        <div class="mock-rows">
                            <div class="mock-row"><i class="fas fa-circle-check"></i><div class="line"></div></div>
                            <div class="mock-row"><i class="fas fa-circle-check"></i><div class="line short"></div></div>
                            <div class="mock-row"><i class="fas fa-circle-check"></i><div class="line"></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Marquee strip --}}
    <div class="marquee-section">
        <div class="marquee-track">
            @php
                $marqueeIcons = ['fa-diagram-project','fa-sack-dollar','fa-file-signature','fa-users-gear','fa-chart-pie','fa-shield-halved','fa-layer-group','fa-file-invoice-dollar'];
            @endphp
            @foreach (array_merge($marqueeIcons, $marqueeIcons) as $icon)
                <i class="fas {{ $icon }}"></i>
            @endforeach
        </div>
    </div>

    {{-- Features --}}
    <section id="features" class="features">
        <div class="container">
            <div class="section-header reveal">
                <span class="section-badge">{{ __('welcome.logo_name') }}</span>
                <h2 class="section-title">{{ __('welcome.features_title') }}</h2>
                <p class="section-subtitle">{{ __('welcome.features_subtitle') }}</p>
            </div>

            <div class="features-grid">
                @php
                    $featureIcons = [
                        1 => 'fa-diagram-project',
                        2 => 'fa-sack-dollar',
                        3 => 'fa-file-signature',
                        4 => 'fa-users-gear',
                        5 => 'fa-chart-pie',
                        6 => 'fa-shield-halved',
                    ];
                @endphp
                @foreach ($featureIcons as $key => $icon)
                    <div class="feature-card reveal r-{{ min(4, $key) }}" onmousemove="tiltGlow(event, this)">
                        <div class="feature-top">
                            <div class="feature-icon"><i class="fas {{ $icon }}"></i></div>
                            <span class="feature-num">0{{ $key }}</span>
                        </div>
                        <h3 class="feature-title">{{ __('welcome.feature_'.$key.'_title') }}</h3>
                        <p class="feature-desc">{{ __('welcome.feature_'.$key.'_desc') }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="cta">
        <div class="container">
            <div class="cta-box reveal">
                <h2 class="cta-title">{{ __('welcome.cta_title') }}</h2>
                <p class="cta-desc">{{ __('welcome.cta_desc') }}</p>

                <div class="cta-buttons">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-arrow-right-to-bracket"></i>
                            {{ __('welcome.cta_login_now') }}
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-arrow-right-to-bracket"></i>
                            {{ __('welcome.hero_cta_login') }}
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h4><i class="fas fa-circle-info"></i> {{ __('welcome.footer_about_title') }}</h4>
                    <p style="color: var(--text-2); font-size: 0.88rem;">{{ __('welcome.footer_about_text') }}</p>
                </div>

                <div class="footer-section">
                    <h4><i class="fas fa-star"></i> {{ __('welcome.footer_features_title') }}</h4>
                    <ul>
                        <li><a href="#"><i class="fas fa-diagram-project"></i> {{ __('welcome.footer_features_projects') }}</a></li>
                        <li><a href="#"><i class="fas fa-wallet"></i> {{ __('welcome.footer_features_finance') }}</a></li>
                        <li><a href="#"><i class="fas fa-chart-line"></i> {{ __('welcome.footer_features_reports') }}</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4><i class="fas fa-life-ring"></i> {{ __('welcome.footer_support_title') }}</h4>
                    <ul>
                        <li><a href="#"><i class="fas fa-circle-question"></i> {{ __('welcome.footer_support_help') }}</a></li>
                        <li><a href="#"><i class="fas fa-book"></i> {{ __('welcome.footer_support_docs') }}</a></li>
                        <li><a href="#"><i class="fas fa-envelope"></i> {{ __('welcome.footer_support_contact') }}</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>© {{ date('Y') }} {{ config('app.name', 'SmartERP') }}. {{ __('welcome.footer_rights') }}</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-x-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', function (e) {
                const t = document.querySelector(this.getAttribute('href'));
                if (t) { e.preventDefault(); t.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
            });
        });

        const navWrap = document.getElementById('nav-wrap');
        window.addEventListener('scroll', () => {
            navWrap.classList.toggle('is-scrolled', window.scrollY > 10);
        }, { passive: true });

        const hero = document.getElementById('hero');
        const spotlight = document.getElementById('spotlight');
        hero.addEventListener('mousemove', (e) => {
            const rect = hero.getBoundingClientRect();
            spotlight.style.setProperty('--mx', (e.clientX - rect.left) + 'px');
            spotlight.style.setProperty('--my', (e.clientY - rect.top) + 'px');
        });

        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });
        document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

        function animateCounter(el) {
            const raw = el.dataset.count.trim();
            const match = raw.match(/^([\d.]+)(.*)$/);
            if (!match) { el.textContent = raw; return; }

            const end = parseFloat(match[1]);
            const suffix = match[2];
            const isDecimal = match[1].includes('.');
            const duration = 1400;
            const start = performance.now();

            function tick(now) {
                const progress = Math.min((now - start) / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 3);
                const current = end * eased;
                el.textContent = (isDecimal ? current.toFixed(1) : Math.round(current)) + suffix;
                if (progress < 1) requestAnimationFrame(tick);
            }
            requestAnimationFrame(tick);
        }
        const statObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) { animateCounter(entry.target); statObserver.unobserve(entry.target); }
            });
        }, { threshold: 0.5 });
        document.querySelectorAll('.stat-number').forEach(el => statObserver.observe(el));

        function tiltGlow(e, card) {
            const rect = card.getBoundingClientRect();
            card.style.setProperty('--mx', (e.clientX - rect.left) + 'px');
            card.style.setProperty('--my', (e.clientY - rect.top) + 'px');
        }
    </script>
</body>
</html>
