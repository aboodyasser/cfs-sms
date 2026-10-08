<x-app-layout>

    {{-- Header --}}
    <x-slot name="header">

        <div class="cfs-profile-header">

            <div>
                <div class="cfs-profile-eyebrow">
                    <span></span>
                    {{ config('app.name', 'SmartERP') }}
                </div>

                <h1 class="cfs-profile-title">
                    {{ __('Profile') }}
                </h1>

                <p class="cfs-profile-subtitle">
                    {{ __('Manage your personal information, password and account settings.') }}
                </p>
            </div>

            <div class="cfs-profile-header-icon">
                <i class="fas fa-user-gear"></i>
            </div>

        </div>

    </x-slot>


    {{-- Profile Content --}}
    <div class="cfs-profile-page">

        {{-- Profile Hero --}}
        <section class="cfs-profile-hero">

            <div class="cfs-profile-hero-content">

                <div class="cfs-profile-avatar">
                    <i class="fas fa-user"></i>
                </div>

                <div>

                    <span class="cfs-profile-badge">
                        <i class="fas fa-shield-halved"></i>
                        {{ __('Account Settings') }}
                    </span>

                    <h2>
                        {{ __('Your Profile') }}
                    </h2>

                    <p>
                        {{ __('Keep your account information up to date and manage your security settings from one place.') }}
                    </p>

                </div>

            </div>

            <div class="cfs-profile-hero-decoration">

                <span class="cfs-profile-orb orb-one"></span>
                <span class="cfs-profile-orb orb-two"></span>

                <span class="cfs-profile-ring ring-one"></span>
                <span class="cfs-profile-ring ring-two"></span>

                <i class="fas fa-user-gear"></i>

            </div>

        </section>


        {{-- Profile Grid --}}
        <div class="cfs-profile-grid">

            {{-- Personal Information --}}
            <section class="cfs-profile-card">

                <div class="cfs-profile-card-header">

                    <div class="cfs-profile-card-heading">

                        <span class="cfs-profile-card-icon blue">
                            <i class="fas fa-user"></i>
                        </span>

                        <div>
                            <span class="cfs-profile-card-kicker">
                                {{ __('Account') }}
                            </span>

                            <h3>
                                {{ __('Profile Information') }}
                            </h3>
                        </div>

                    </div>

                    <span class="cfs-profile-card-status">
                        <i class="fas fa-circle-check"></i>
                        {{ __('Active') }}
                    </span>

                </div>

                <div class="cfs-profile-card-body">

                    <p class="cfs-profile-description">
                        {{ __("Update your account's profile information and email address.") }}
                    </p>

                    <div class="cfs-profile-form-wrapper">

                        @include('profile.partials.update-profile-information-form')

                    </div>

                </div>

            </section>


            {{-- Password --}}
            <section class="cfs-profile-card">

                <div class="cfs-profile-card-header">

                    <div class="cfs-profile-card-heading">

                        <span class="cfs-profile-card-icon purple">
                            <i class="fas fa-lock"></i>
                        </span>

                        <div>
                            <span class="cfs-profile-card-kicker">
                                {{ __('Security') }}
                            </span>

                            <h3>
                                {{ __('Update Password') }}
                            </h3>
                        </div>

                    </div>

                    <span class="cfs-profile-security-badge">
                        <i class="fas fa-shield-halved"></i>
                        {{ __('Secure') }}
                    </span>

                </div>

                <div class="cfs-profile-card-body">

                    <p class="cfs-profile-description">
                        {{ __('Use a strong password to keep your account secure.') }}
                    </p>

                    <div class="cfs-profile-form-wrapper">

                        @include('profile.partials.update-password-form')

                    </div>

                </div>

            </section>


            {{-- Delete Account --}}
            <section class="cfs-profile-card cfs-profile-danger-card">

                <div class="cfs-profile-card-header">

                    <div class="cfs-profile-card-heading">

                        <span class="cfs-profile-card-icon red">
                            <i class="fas fa-user-slash"></i>
                        </span>

                        <div>
                            <span class="cfs-profile-card-kicker danger">
                                {{ __('Danger Zone') }}
                            </span>

                            <h3>
                                {{ __('Delete Account') }}
                            </h3>
                        </div>

                    </div>

                    <span class="cfs-profile-danger-badge">
                        <i class="fas fa-triangle-exclamation"></i>
                        {{ __('Permanent') }}
                    </span>

                </div>

                <div class="cfs-profile-card-body">

                    <p class="cfs-profile-description">
                        {{ __('Permanently delete your account and all of its associated data.') }}
                    </p>

                    <div class="cfs-profile-form-wrapper">

                        @include('profile.partials.delete-user-form')

                    </div>

                </div>

            </section>

        </div>


        {{-- Security Notice --}}
        <section class="cfs-profile-security-notice">

            <div class="cfs-security-notice-icon">
                <i class="fas fa-shield-halved"></i>
            </div>

            <div>

                <strong>
                    {{ __('Account Security') }}
                </strong>

                <p>
                    {{ __('Your account security is important. Keep your password private and make sure your profile information is always up to date.') }}
                </p>

            </div>

        </section>

    </div>


    @push('styles')

        <style>

            /* =========================================================
               CFS PROFILE — PREMIUM INSTITUTIONAL UI
            ========================================================= */

            .cfs-profile-header {
                display: flex;
                align-items: flex-end;
                justify-content: space-between;
                gap: 1.5rem;
                flex-wrap: wrap;
            }

            .cfs-profile-eyebrow {
                display: flex;
                align-items: center;
                gap: .45rem;
                margin-bottom: .55rem;
                color: #059669;
                font-size: .7rem;
                font-weight: 800;
                letter-spacing: .08em;
                text-transform: uppercase;
            }

            .cfs-profile-eyebrow span {
                width: 7px;
                height: 7px;
                border-radius: 50%;
                background: #059669;
                box-shadow: 0 0 0 4px rgba(5,150,105,.1);
            }

            .cfs-profile-title {
                margin: 0;
                color: var(--cfs-text);
                font-size: clamp(1.8rem, 3vw, 2.45rem);
                line-height: 1.1;
                font-weight: 800;
                letter-spacing: -.03em;
            }

            .cfs-profile-subtitle {
                margin: .55rem 0 0;
                color: var(--cfs-text-2);
                font-size: .92rem;
            }

            .cfs-profile-header-icon {
                width: 48px;
                height: 48px;
                display: flex;
                align-items: center;
                justify-content: center;
                border: 1px solid rgba(14,165,233,.15);
                border-radius: 1rem;
                color: var(--cfs-primary);
                background: rgba(14,165,233,.07);
                font-size: 1.1rem;
            }


            /* Page */

            .cfs-profile-page {
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
            }


            /* Hero */

            .cfs-profile-hero {
                position: relative;
                min-height: 205px;
                overflow: hidden;
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 2rem 2.25rem;
                border: 1px solid var(--cfs-line);
                border-radius: var(--cfs-radius-xl);
                background: var(--card);
                box-shadow: 0 15px 45px rgba(15,23,42,.07);
            }

            .cfs-profile-hero::after {
                content: "";
                position: absolute;
                inset: 0;
                pointer-events: none;

                background:
                    radial-gradient(
                        circle at 15% 10%,
                        rgba(14,165,233,.10),
                        transparent 34%
                    ),
                    radial-gradient(
                        circle at 85% 90%,
                        rgba(217,70,239,.08),
                        transparent 36%
                    );
            }

            .cfs-profile-hero-content {
                position: relative;
                z-index: 3;

                display: flex;
                align-items: center;
                gap: 1.25rem;

                max-width: 720px;
            }

            .cfs-profile-avatar {
                width: 76px;
                height: 76px;

                flex-shrink: 0;

                display: flex;
                align-items: center;
                justify-content: center;

                border-radius: 1.5rem;

                color: #fff;

                background:
                    linear-gradient(
                        135deg,
                        var(--cfs-primary),
                        var(--cfs-primary-dark)
                    );

                font-size: 1.8rem;

                box-shadow:
                    0 15px 35px rgba(14,165,233,.25),
                    0 0 0 10px rgba(14,165,233,.06);
            }

            .cfs-profile-badge {
                display: inline-flex;
                align-items: center;
                gap: .45rem;

                padding: .4rem .75rem;

                border: 1px solid rgba(14,165,233,.15);
                border-radius: 999px;

                color: var(--cfs-primary-dark);
                background: rgba(14,165,233,.07);

                font-size: .68rem;
                font-weight: 700;
            }

            .cfs-profile-badge i {
                color: var(--cfs-primary);
            }

            .cfs-profile-hero h2 {
                margin: .7rem 0 .4rem;

                color: var(--cfs-text);

                font-size: clamp(1.45rem, 3vw, 2rem);
                line-height: 1.15;
                font-weight: 800;
                letter-spacing: -.03em;
            }

            .cfs-profile-hero p {
                max-width: 620px;

                margin: 0;

                color: var(--cfs-text-2);

                font-size: .86rem;
                line-height: 1.8;
            }


            /* Decorative Hero */

            .cfs-profile-hero-decoration {
                position: absolute;

                width: 280px;
                height: 280px;

                right: 55px;
                top: 50%;

                transform: translateY(-50%);
            }

            [dir="rtl"] .cfs-profile-hero-decoration {
                right: auto;
                left: 55px;
            }

            .cfs-profile-hero-decoration > i {
                position: absolute;

                left: 50%;
                top: 50%;

                transform: translate(-50%, -50%);

                width: 72px;
                height: 72px;

                display: flex;
                align-items: center;
                justify-content: center;

                border-radius: 1.35rem;

                color: #fff;

                background:
                    linear-gradient(
                        135deg,
                        var(--cfs-primary),
                        var(--cfs-primary-dark)
                    );

                font-size: 1.6rem;

                box-shadow:
                    0 18px 40px rgba(14,165,233,.25),
                    0 0 0 10px rgba(14,165,233,.06);

                z-index: 3;
            }

            .cfs-profile-orb {
                position: absolute;
                inset: 20px;

                border-radius: 50%;

                filter: blur(20px);
            }

            .cfs-profile-orb.orb-one {
                background: rgba(14,165,233,.15);
            }

            .cfs-profile-orb.orb-two {
                transform: translate(30px, 20px);
                background: rgba(217,70,239,.10);
            }

            .cfs-profile-ring {
                position: absolute;

                left: 50%;
                top: 50%;

                border: 1px solid rgba(14,165,233,.18);
                border-radius: 50%;

                transform: translate(-50%, -50%);
            }

            .cfs-profile-ring.ring-one {
                width: 145px;
                height: 145px;
            }

            .cfs-profile-ring.ring-two {
                width: 220px;
                height: 220px;

                border-color: rgba(217,70,239,.12);
            }


            /* Main Grid */

            .cfs-profile-grid {
                display: grid;

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

                gap: 1.5rem;
            }


            /* Cards */

            .cfs-profile-card {
                min-width: 0;

                overflow: hidden;

                border: 1px solid var(--cfs-line);
                border-radius: var(--cfs-radius-lg);

                background: rgba(255,255,255,.92);

                box-shadow:
                    0 5px 20px rgba(15,23,42,.035);

                transition:
                    transform .3s var(--cfs-ease),
                    box-shadow .3s ease,
                    border-color .3s ease;
            }

            .cfs-profile-card:hover {
                transform: translateY(-2px);

                border-color: rgba(14,165,233,.18);

                box-shadow:
                    0 14px 35px rgba(15,23,42,.07);
            }

            .cfs-profile-card:nth-child(3) {
                grid-column: 1 / -1;
            }


            /* Card Header */

            .cfs-profile-card-header {
                display: flex;
                align-items: center;
                justify-content: space-between;

                gap: 1rem;

                padding: 1.2rem 1.3rem;

                border-bottom: 1px solid var(--cfs-line);

                background:
                    linear-gradient(
                        180deg,
                        rgba(248,250,252,.9),
                        rgba(255,255,255,.7)
                    );
            }

            .cfs-profile-card-heading {
                display: flex;
                align-items: center;
                gap: .8rem;

                min-width: 0;
            }

            .cfs-profile-card-icon {
                width: 42px;
                height: 42px;

                flex-shrink: 0;

                display: flex;
                align-items: center;
                justify-content: center;

                border-radius: .8rem;

                font-size: .9rem;
            }

            .cfs-profile-card-icon.blue {
                color: var(--cfs-primary);
                background: rgba(14,165,233,.10);
            }

            .cfs-profile-card-icon.purple {
                color: var(--cfs-secondary);
                background: rgba(217,70,239,.10);
            }

            .cfs-profile-card-icon.red {
                color: #DC2626;
                background: rgba(220,38,38,.08);
            }

            .cfs-profile-card-kicker {
                display: block;

                margin-bottom: .15rem;

                color: var(--cfs-primary);

                font-size: .58rem;
                font-weight: 800;

                letter-spacing: .08em;
                text-transform: uppercase;
            }

            .cfs-profile-card-kicker.danger {
                color: #DC2626;
            }

            .cfs-profile-card-header h3 {
                margin: 0;

                color: var(--cfs-text);

                font-size: .95rem;
                font-weight: 800;
            }


            /* Status */

            .cfs-profile-card-status,
            .cfs-profile-security-badge,
            .cfs-profile-danger-badge {
                display: inline-flex;
                align-items: center;
                gap: .35rem;

                padding: .4rem .65rem;

                border-radius: 999px;

                font-size: .6rem;
                font-weight: 700;

                white-space: nowrap;
            }

            .cfs-profile-card-status {
                color: #059669;
                background: rgba(5,150,105,.08);
            }

            .cfs-profile-security-badge {
                color: var(--cfs-secondary);
                background: rgba(217,70,239,.08);
            }

            .cfs-profile-danger-badge {
                color: #DC2626;
                background: rgba(220,38,38,.07);
            }


            /* Body */

            .cfs-profile-card-body {
                padding: 1.3rem;
            }

            .cfs-profile-description {
                margin: 0 0 1rem;

                color: var(--cfs-text-2);

                font-size: .78rem;
                line-height: 1.7;
            }

            .cfs-profile-form-wrapper {
                padding: 1rem;

                border: 1px solid var(--cfs-line);

                border-radius: .9rem;

                background: var(--cfs-bg);
            }


            /* Make Breeze partials match CFS */

            .cfs-profile-form-wrapper label {
                color: var(--cfs-text) !important;
                font-size: .76rem !important;
                font-weight: 700 !important;
            }

            .cfs-profile-form-wrapper input,
            .cfs-profile-form-wrapper select,
            .cfs-profile-form-wrapper textarea {
                width: 100%;

                border-color: var(--cfs-line-strong) !important;
                border-radius: .7rem !important;

                background: var(--card) !important;

                color: var(--cfs-text) !important;

                font-size: .8rem !important;

                transition:
                    border-color .2s ease,
                    box-shadow .2s ease;
            }

            .cfs-profile-form-wrapper input:focus,
            .cfs-profile-form-wrapper select:focus,
            .cfs-profile-form-wrapper textarea:focus {
                border-color: var(--cfs-primary) !important;

                box-shadow:
                    0 0 0 3px rgba(14,165,233,.10) !important;

                outline: none !important;
            }

            .cfs-profile-form-wrapper button {
                border-radius: .7rem !important;

                font-size: .72rem !important;
                font-weight: 700 !important;
            }


            /* Danger */

            .cfs-profile-danger-card {
                border-color: rgba(220,38,38,.12);
            }

            .cfs-profile-danger-card:hover {
                border-color: rgba(220,38,38,.22);
            }


            /* Security Notice */

            .cfs-profile-security-notice {
                display: flex;
                align-items: center;

                gap: .9rem;

                padding: 1rem 1.2rem;

                border: 1px solid rgba(14,165,233,.13);
                border-radius: var(--cfs-radius-lg);

                background:
                    linear-gradient(
                        135deg,
                        rgba(14,165,233,.055),
                        rgba(217,70,239,.035)
                    );
            }

            .cfs-security-notice-icon {
                width: 42px;
                height: 42px;

                flex-shrink: 0;

                display: flex;
                align-items: center;
                justify-content: center;

                border-radius: .8rem;

                color: var(--cfs-primary);

                background: rgba(14,165,233,.09);
            }

            .cfs-profile-security-notice strong {
                display: block;

                color: var(--cfs-text);

                font-size: .76rem;
                font-weight: 800;
            }

            .cfs-profile-security-notice p {
                margin: .2rem 0 0;

                color: var(--cfs-text-2);

                font-size: .67rem;
                line-height: 1.7;
            }


            /* RTL */

            [dir="rtl"] .cfs-profile-card-header,
            [dir="rtl"] .cfs-profile-header {
                text-align: right;
            }


            /* Responsive */

            @media (max-width: 1000px) {

                .cfs-profile-hero-decoration {
                    opacity: .45;
                }

                .cfs-profile-grid {
                    grid-template-columns: 1fr;
                }

                .cfs-profile-card:nth-child(3) {
                    grid-column: auto;
                }

            }


            @media (max-width: 700px) {

                .cfs-profile-hero {
                    padding: 1.5rem;
                }

                .cfs-profile-hero-content {
                    align-items: flex-start;
                }

                .cfs-profile-avatar {
                    width: 60px;
                    height: 60px;
                    border-radius: 1.1rem;
                    font-size: 1.35rem;
                }

                .cfs-profile-hero-decoration {
                    display: none;
                }

                .cfs-profile-card-header {
                    align-items: flex-start;
                    flex-direction: column;
                }

                .cfs-profile-card-status,
                .cfs-profile-security-badge,
                .cfs-profile-danger-badge {
                    align-self: flex-start;
                }

            }


            @media (max-width: 520px) {

                .cfs-profile-header-icon {
                    display: none;
                }

                .cfs-profile-hero-content {
                    flex-direction: column;
                }

                .cfs-profile-card-body {
                    padding: 1rem;
                }

                .cfs-profile-form-wrapper {
                    padding: .8rem;
                }

                .cfs-profile-security-notice {
                    align-items: flex-start;
                }

            }

        </style>

    @endpush

</x-app-layout>
