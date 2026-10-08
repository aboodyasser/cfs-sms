
@php
    $isRtl = app()->getLocale() === 'ar';
@endphp

<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ $isRtl ? 'rtl' : 'ltr' }}"
>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ __('Login') }} — SmartERP</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>
        :root {
            --cfs-primary: #0EA5E9;
            --cfs-primary-dark: #0369A1;
            --cfs-secondary: #D946EF;
            --cfs-accent: #F59E0B;
            --cfs-bg: #F8FAFC;
            --cfs-surface: #FFFFFF;
            --cfs-text: #0F172A;
            --cfs-muted: #64748B;
            --cfs-border: #E2E8F0;
        }

        html.dark {
            --cfs-bg: #0F172A;
            --cfs-surface: #1E293B;
            --cfs-text: #F8FAFC;
            --cfs-muted: #94A3B8;
            --cfs-border: rgba(255, 255, 255, 0.1);
            --cfs-primary: #38BDF8;
            --cfs-primary-dark: #0284C7;
        }


        * {
            box-sizing: border-box;
        }

        html,
        body {
            min-height: 100%;
        }

        body {
            margin: 0;
            background:
                radial-gradient(circle at 10% 10%, rgba(14, 165, 233, .10), transparent 30%),
                radial-gradient(circle at 90% 90%, rgba(217, 70, 239, .08), transparent 28%),
                var(--cfs-bg);
            color: var(--cfs-text);
            font-family: "Outfit", "IBM Plex Sans Arabic", sans-serif;
        }

        html[dir="rtl"] body {
            font-family: "IBM Plex Sans Arabic", "Outfit", sans-serif;
        }

        .login-shell {
            position: relative;
            min-height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 20px;
        }

        /* Background grid */
        .login-grid {
            position: absolute;
            inset: 0;
            pointer-events: none;
            opacity: .55;
            background-image:
                linear-gradient(rgba(148, 163, 184, .10) 1px, transparent 1px),
                linear-gradient(90deg, rgba(148, 163, 184, .10) 1px, transparent 1px);
            background-size: 42px 42px;
            mask-image: linear-gradient(to bottom, black, transparent 90%);
        }

        /* Decorative orbs */
        .login-orb {
            position: absolute;
            border-radius: 9999px;
            pointer-events: none;
            filter: blur(2px);
        }

        .login-orb-one {
            width: 420px;
            height: 420px;
            top: -220px;
            inset-inline-start: -160px;
            background: radial-gradient(
                circle,
                rgba(14, 165, 233, .16),
                rgba(14, 165, 233, 0)
            );
        }

        .login-orb-two {
            width: 460px;
            height: 460px;
            bottom: -250px;
            inset-inline-end: -170px;
            background: radial-gradient(
                circle,
                rgba(217, 70, 239, .13),
                rgba(217, 70, 239, 0)
            );
        }

        /* Main card */
        .login-card {
            position: relative;
            z-index: 5;
            width: 100%;
            max-width: 1080px;
            display: grid;
            grid-template-columns: minmax(0, .92fr) minmax(0, 1.08fr);
            overflow: hidden;
            border: 1px solid var(--cfs-border);
            border-radius: 30px;
            background: var(--cfs-surface);
            box-shadow:
                0 30px 80px rgba(15, 23, 42, .10),
                0 8px 30px rgba(15, 23, 42, .05);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        /* Brand panel */
        .brand-panel {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 620px;
            padding: 44px;
            overflow: hidden;
            background:
                linear-gradient(
                    145deg,
                    #075985 0%,
                    #0369A1 48%,
                    #0EA5E9 100%
                );
            color: white;
        }

        .brand-panel::before {
            content: "";
            position: absolute;
            width: 340px;
            height: 340px;
            border-radius: 50%;
            top: -170px;
            inset-inline-end: -150px;
            border: 1px solid rgba(255,255,255,.13);
            box-shadow:
                0 0 0 45px rgba(255,255,255,.025),
                0 0 0 90px rgba(255,255,255,.02);
        }

        .brand-panel::after {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            bottom: -170px;
            inset-inline-start: -130px;
            background: rgba(255,255,255,.06);
        }

        .brand-content,
        .brand-footer {
            position: relative;
            z-index: 2;
        }

        .brand-logo {
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.20);
            box-shadow: 0 12px 30px rgba(0,0,0,.12);
            backdrop-filter: blur(10px);
        }

        .brand-title {
            margin-top: 34px;
            font-size: clamp(2rem, 4vw, 3.2rem);
            line-height: 1.08;
            font-weight: 800;
            letter-spacing: -.04em;
        }

        .brand-title span {
            display: block;
            margin-top: 6px;
            background: linear-gradient(
                90deg,
                #ffffff,
                #BAE6FD
            );
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .brand-description {
            max-width: 440px;
            margin-top: 20px;
            color: rgba(255,255,255,.76);
            font-size: 15px;
            line-height: 1.8;
        }

        .brand-features {
            display: grid;
            gap: 12px;
            margin-top: 32px;
        }

        .brand-feature {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255,255,255,.88);
            font-size: 13px;
            font-weight: 500;
        }

        .brand-feature-icon {
            width: 34px;
            height: 34px;
            flex: 0 0 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            background: rgba(255,255,255,.11);
            border: 1px solid rgba(255,255,255,.13);
        }

        .brand-footer {
            padding-top: 35px;
            color: rgba(255,255,255,.55);
            font-size: 11px;
            letter-spacing: .03em;
        }

        /* Form panel */
        .form-panel {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px;
            background: var(--cfs-surface);
        }

        .form-container {
            width: 100%;
            max-width: 410px;
        }

        .mobile-brand {
            display: none;
        }

        .form-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 13px;
            color: var(--cfs-primary-dark);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .12em;
        }

        .form-eyebrow-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--cfs-primary);
            box-shadow: 0 0 0 5px rgba(14,165,233,.10);
        }

        .form-title {
            margin: 0;
            color: var(--cfs-text);
            font-size: 30px;
            line-height: 1.2;
            font-weight: 800;
            letter-spacing: -.035em;
        }

        .form-subtitle {
            margin-top: 10px;
            color: var(--cfs-muted);
            font-size: 13px;
            line-height: 1.7;
        }

        .status-box {
            margin-bottom: 22px;
            padding: 11px 13px;
            border: 1px solid #BAE6FD;
            border-radius: 13px;
            background: var(--cfs-bg);
            color: var(--cfs-primary-dark);
            font-size: 12px;
            line-height: 1.6;
        }

        .login-form {
            margin-top: 30px;
        }

        .field-group + .field-group {
            margin-top: 19px;
        }

        .field-label {
            display: block;
            margin-bottom: 8px;
            color: var(--cfs-text);
            font-size: 12px;
            font-weight: 700;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            inset-inline-start: 14px;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 18px;
            height: 18px;
            color: var(--cfs-muted);
            pointer-events: none;
            transition: color .2s ease;
        }

        .field-input {
            display: block;
            width: 100%;
            min-height: 48px;
            padding: 0 14px;
            padding-inline-start: 43px;
            border: 1px solid #E2E8F0;
            border-radius: 14px;
            outline: none;
            background: var(--cfs-bg);
            color: var(--cfs-text);
            font-family: inherit;
            font-size: 13px;
            transition:
                border-color .2s ease,
                background .2s ease,
                box-shadow .2s ease;
        }

        .field-input::placeholder {
            color: var(--cfs-muted);
        }

        .field-input:hover {
            border-color: var(--cfs-border);
            background: var(--cfs-surface);
        }

        .field-input:focus {
            border-color: var(--cfs-primary);
            background: var(--cfs-surface);
            box-shadow:
                0 0 0 4px rgba(14,165,233,.10);
        }

        .input-wrap:focus-within .input-icon {
            color: var(--cfs-primary);
        }

        .error-message {
            margin-top: 6px;
            color: #E11D48;
            font-size: 11px;
            line-height: 1.5;
        }

        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-top: 19px;
        }

        .remember-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            color: var(--cfs-muted);
            font-size: 12px;
            font-weight: 500;
        }

        .remember-checkbox {
            width: 16px;
            height: 16px;
            margin: 0;
            border: 1px solid #CBD5E1;
            border-radius: 5px;
            accent-color: var(--cfs-primary);
        }

        .forgot-link {
            color: var(--cfs-primary-dark);
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            transition: color .2s ease;
        }

        .forgot-link:hover {
            color: var(--cfs-primary-dark);
            text-decoration: underline;
        }

        .login-button {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            width: 100%;
            min-height: 49px;
            margin-top: 25px;
            border: 0;
            border-radius: 14px;
            background: linear-gradient(
                135deg,
                #0EA5E9,
                #0369A1
            );
            color: white;
            font-family: inherit;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            box-shadow:
                0 10px 25px rgba(14,165,233,.22);
            transition:
                transform .2s ease,
                box-shadow .2s ease,
                filter .2s ease;
        }

        .login-button:hover {
            transform: translateY(-1px);
            box-shadow:
                0 14px 30px rgba(14,165,233,.28);
            filter: brightness(1.03);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .login-button:focus {
            outline: none;
            box-shadow:
                0 0 0 4px rgba(14,165,233,.14),
                0 10px 25px rgba(14,165,233,.22);
        }

        .form-bottom {
            margin-top: 25px;
            padding-top: 19px;
            border-top: 1px solid #F1F5F9;
            text-align: center;
            color: var(--cfs-muted);
            font-size: 10px;
            line-height: 1.7;
        }

        /* RTL refinements */
        [dir="rtl"] .brand-title,
        [dir="rtl"] .form-title,
        [dir="rtl"] .form-subtitle {
            letter-spacing: 0;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .login-card {
                max-width: 620px;
                grid-template-columns: 1fr;
            }

            .brand-panel {
                display: none;
            }

            .form-panel {
                min-height: 650px;
                padding: 42px 34px;
            }

            .mobile-brand {
                display: flex;
                align-items: center;
                gap: 13px;
                margin-bottom: 32px;
            }

            .mobile-brand-logo {
                width: 46px;
                height: 46px;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 14px;
                background: var(--cfs-bg);
                color: var(--cfs-primary-dark);
                border: 1px solid var(--cfs-border);
            }

            .mobile-brand-name {
                color: var(--cfs-text);
                font-size: 17px;
                font-weight: 800;
            }

            .mobile-brand-subtitle {
                margin-top: 1px;
                color: var(--cfs-muted);
                font-size: 10px;
            }
        }

        @media (max-width: 560px) {
            .login-shell {
                padding: 18px 12px;
            }

            .login-card {
                border-radius: 24px;
            }

            .form-panel {
                min-height: auto;
                padding: 30px 22px;
            }

            .form-title {
                font-size: 26px;
            }

            .form-subtitle {
                font-size: 12px;
            }

            .form-options {
                align-items: flex-start;
                flex-direction: column;
            }

            .login-form {
                margin-top: 25px;
            }
        }
    </style>
<script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body>

    <main class="login-shell">

        {{-- Background --}}
        <div class="login-grid"></div>
        <div class="login-orb login-orb-one"></div>
        <div class="login-orb login-orb-two"></div>


        <section class="login-card">

            {{-- =====================================================
                 Brand Panel
            ====================================================== --}}
            <div class="brand-panel">

                <div class="brand-content">

                    <div class="brand-logo" style="padding: 4px;"><img src="{{ asset('images/smarterp_logo_cropped.jpg') }}" alt="Logo" style="width: 100%; height: 100%; object-fit: contain; border-radius: 14px;"></div>


                    <h1 class="brand-title">
                        {{ config('app.name', 'SmartERP') }}
                        <span>Smart Management System</span>
                    </h1>


                    <p class="brand-description">
                        {{ __('A professional institutional platform for managing projects, contracts, finance, human resources, documents, and reports in one secure system.') }}
                    </p>


                    <div class="brand-features">

                        <div class="brand-feature">

                            <span class="brand-feature-icon">
                                <svg
                                    class="h-4 w-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M12 15v2m-6 4h12a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2Zm3-10V7a3 3 0 0 1 6 0v2"
                                    />
                                </svg>
                            </span>

                            <span>
                                {{ __('Secure & Permission-Based Access') }}
                            </span>

                        </div>


                        <div class="brand-feature">

                            <span class="brand-feature-icon">
                                <svg
                                    class="h-4 w-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M4 19V5m0 14h16M8 16v-4m4 4V8m4 8V5"
                                    />
                                </svg>
                            </span>

                            <span>
                                {{ __('Centralized Management & Reporting') }}
                            </span>

                        </div>


                        <div class="brand-feature">

                            <span class="brand-feature-icon">
                                <svg
                                    class="h-4 w-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M12 3v18m9-9H3"
                                    />
                                </svg>
                            </span>

                            <span>
                                {{ __('Designed for Institutional Workflows') }}
                            </span>

                        </div>

                    </div>

                </div>


                <div class="brand-footer">
                    SmartERP · {{ date('Y') }}
                </div>

            </div>


            {{-- =====================================================
                 Login Form
            ====================================================== --}}
            <div class="form-panel">

                <div class="form-container">

                    {{-- Mobile Brand --}}
                    <div class="mobile-brand">

                        <div class="mobile-brand-logo" style="padding: 2px;"><img src="{{ asset('images/smarterp_logo_cropped.jpg') }}" alt="Logo" style="width: 100%; height: 100%; object-fit: contain; border-radius: 12px;"></div>

                        <div>
                            <div class="mobile-brand-name">
                                SmartERP
                            </div>

                            <div class="mobile-brand-subtitle">
                                Smart Management System
                            </div>
                        </div>

                    </div>


                    {{-- Header --}}
                    <div>

                        <div class="form-eyebrow">

                            <span class="form-eyebrow-dot"></span>

                            {{ __('Secure Access') }}

                        </div>


                        <h2 class="form-title">{{ $title ?? '' }}</h2>
                        <p class="form-subtitle">{{ $subtitle ?? '' }}</p>
                    </div>
                    
                    {{-- Session Status --}}
                    @if (session('status'))
                        <div class="status-box mt-6" style="margin-bottom: 20px; padding: 10px; background: rgba(16, 185, 129, 0.1); color: #059669; border-radius: 8px; font-size: 13px;">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ $slot }}
                    
                    <div class="form-bottom">
                        {{ __('Authorized access only. Please use your institutional account.') }}
                    </div>

                </div>

            </div>

        </section>

    </main>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const eyeIcon = document.getElementById('eyeIcon');

        if (!passwordInput || !togglePassword || !eyeIcon) {
            return;
        }

        togglePassword.addEventListener('click', function () {

            const isHidden = passwordInput.type === 'password';

            passwordInput.type = isHidden ? 'text' : 'password';

            togglePassword.setAttribute(
                'aria-label',
                isHidden
                    ? @json(__('Hide password'))
                    : @json(__('Show password'))
            );

            togglePassword.setAttribute(
                'title',
                isHidden
                    ? @json(__('Hide password'))
                    : @json(__('Show password'))
            );

            if (isHidden) {

                // Eye Off
                eyeIcon.innerHTML = `
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.7"
                        d="m3 3 18 18"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.7"
                        d="M10.6 10.6a2 2 0 0 0 2.8 2.8"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.7"
                        d="M9.9 5.2A10.8 10.8 0 0 1 12 5c6 0 9.5 7 9.5 7a17 17 0 0 1-3.1 3.9"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.7"
                        d="M6.1 6.1C3.7 8 2.5 12 2.5 12s3.5 6 9.5 6c1.7 0 3.2-.4 4.5-1"
                    />
                `;

            } else {

                // Eye
                eyeIcon.innerHTML = `
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.7"
                        d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"
                    />

                    <circle
                        cx="12"
                        cy="12"
                        r="2.5"
                        stroke-width="1.7"
                    />
                `;
            }
        });

    });
</script>
</body>
</html>



