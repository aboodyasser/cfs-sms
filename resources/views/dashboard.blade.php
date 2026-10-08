<x-app-layout>

<x-slot name="header">

    <div class="cfs-dashboard-header">

        <div>
            <div class="cfs-dashboard-eyebrow">
                <span></span>
                {{ config('app.name', 'SmartERP') }}
            </div>

            <h1 class="cfs-dashboard-title">
                {{ __('Dashboard') }}
            </h1>

            <p class="cfs-dashboard-subtitle">
                {{ __('Welcome back. Here is an overview of your management system.') }}
            </p>
        </div>

        <div class="cfs-dashboard-date">
            <i class="fas fa-calendar-days"></i>
            {{ \Carbon\Carbon::now()->locale(app()->getLocale())->translatedFormat('d F Y') }}
        </div>

    </div>

</x-slot>


{{-- Dashboard Content --}}
<div class="cfs-dashboard">

    {{-- Welcome Banner --}}
    <section class="cfs-welcome-card">

        <div class="cfs-welcome-content">

            <span class="cfs-welcome-badge">
                <i class="fas fa-bolt"></i>
                {{ __('System Overview') }}
            </span>

            <h2>
                {{ __('Everything under control.') }}
            </h2>

            <p>
                {{ __('Manage projects, contracts, financial operations and organizational data from one centralized platform.') }}
            </p>

            <div class="cfs-welcome-actions">

    @can('view_projects')
        <a
            href="{{ route('admin.projects.index') }}"
            class="cfs-dashboard-btn primary"
        >
            <i class="fas fa-layer-group"></i>
            {{ __('View Projects') }}
        </a>
    @endcan

    @can('view_contracts')
        <a
            href="{{ route('admin.contracts.index') }}"
            class="cfs-dashboard-btn secondary"
        >
            <i class="fas fa-handshake"></i>
            {{ __('View Contracts') }}
        </a>
    @endcan

    @can('view_reports')
        <a
            href="{{ route('admin.financial-reports.index') }}"
            class="cfs-dashboard-btn secondary"
        >
            <i class="fas fa-vault"></i>
            {{ __('Financial Reports') }}
        </a>
    @endcan

</div>

        </div>

        <div class="cfs-welcome-visual">

            <div class="cfs-visual-orb orb-a"></div>
            <div class="cfs-visual-orb orb-b"></div>

            <div class="cfs-visual-icon">
                <i class="fas fa-landmark"></i>
            </div>

            <div class="cfs-visual-ring ring-one"></div>
            <div class="cfs-visual-ring ring-two"></div>

        </div>

    </section>


    {{-- KPI Cards --}}
    <section class="cfs-kpi-grid">

        @can('view_projects')
    <a
        href="{{ route('admin.projects.index') }}"
        class="cfs-kpi-card cfs-kpi-card-link"
    >
@else
    <div class="cfs-kpi-card">
@endcan

        <div class="cfs-kpi-top">
            <span class="cfs-kpi-icon blue">
                <i class="fas fa-layer-group"></i>
            </span>

            <span class="cfs-kpi-trend">
                <i class="fas fa-arrow-trend-up"></i>
            </span>
        </div>



        <span class="cfs-kpi-label">
            {{ __('Projects') }}
        </span>

        <strong class="cfs-kpi-value">
            128
        </strong>

        <div class="cfs-kpi-footer">
    <span>{{ __('Active projects') }}</span>
    <span class="cfs-kpi-percent">+12%</span>
</div>

@can('view_projects')
    </a>
@else
    </div>
@endcan




@can('view_projects')

    <a
        href="{{ route('admin.projects.index') }}"
        class="cfs-quick-card"
    >
        <span class="cfs-quick-icon blue">
            <i class="fas fa-layer-group"></i>
        </span>

        <span>
            <strong>{{ __('Projects') }}</strong>
            <small>{{ __('Manage and monitor projects') }}</small>
        </span>

        <i class="fas {{ app()->getLocale() === 'ar' ? 'fa-arrow-left' : 'fa-arrow-right' }} cfs-quick-arrow"></i>
    </a>

@endcan
        <div class="cfs-kpi-card">

            <div class="cfs-kpi-top">
                <span class="cfs-kpi-icon purple">
                    <i class="fas fa-handshake"></i>
                </span>

                <span class="cfs-kpi-trend">
                    <i class="fas fa-arrow-trend-up"></i>
                </span>
            </div>

            <span class="cfs-kpi-label">
                {{ __('Contracts') }}
            </span>

            <strong class="cfs-kpi-value">
                64
            </strong>

            <div class="cfs-kpi-footer">
                <span>{{ __('Registered contracts') }}</span>
                <span class="cfs-kpi-percent">+8%</span>
            </div>

        </div>


        <div class="cfs-kpi-card">

            <div class="cfs-kpi-top">
                <span class="cfs-kpi-icon amber">
                    <i class="fas fa-sack-dollar"></i>
                </span>

                <span class="cfs-kpi-trend">
                    <i class="fas fa-arrow-trend-up"></i>
                </span>
            </div>

            <span class="cfs-kpi-label">
                {{ __('Financial Operations') }}
            </span>

            <strong class="cfs-kpi-value">
                ₪ 2.4M
            </strong>

            <div class="cfs-kpi-footer">
                <span>{{ __('Total Value') }}</span>
                <span class="cfs-kpi-percent">+18%</span>
            </div>

        </div>


        <div class="cfs-kpi-card">

            <div class="cfs-kpi-top">
                <span class="cfs-kpi-icon green">
                    <i class="fas fa-chart-line"></i>
                </span>

                <span class="cfs-kpi-trend">
                    <i class="fas fa-check"></i>
                </span>
            </div>

            <span class="cfs-kpi-label">
                {{ __('Reports') }}
            </span>

            <strong class="cfs-kpi-value">
                98%
            </strong>

            <div class="cfs-kpi-footer">
                <span>{{ __('System Performance') }}</span>
                <span class="cfs-kpi-percent">Excellent</span>
            </div>

        </div>

    </section>


    {{-- Main Grid --}}
    <section class="cfs-dashboard-grid">

        {{-- Activity --}}
        <div class="cfs-panel activity-panel">

            <div class="cfs-panel-header">

                <div>
                    <span class="cfs-panel-kicker">
                        {{ __('Overview') }}
                    </span>

                    <h3>
                        {{ __('Recent Activity') }}
                    </h3>
                </div>

                <button class="cfs-panel-menu">
                    <i class="fas fa-ellipsis"></i>
                </button>

            </div>


            <div class="cfs-chart">

                <div class="cfs-chart-y">
                    <span>100</span>
                    <span>75</span>
                    <span>50</span>
                    <span>25</span>
                    <span>0</span>
                </div>

                <div class="cfs-chart-area">

                    <div class="cfs-chart-grid-lines">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                    <div class="cfs-bars">

                        @foreach ([45, 62, 50, 78, 58, 88, 68, 94, 72, 84, 64, 91] as $height)

                            <div
                                class="cfs-bar"
                                style="height: {{ $height }}%;"
                            ></div>

                        @endforeach

                    </div>

                    <div class="cfs-chart-labels">
                        <span>Jan</span>
                        <span>Feb</span>
                        <span>Mar</span>
                        <span>Apr</span>
                        <span>May</span>
                        <span>Jun</span>
                        <span>Jul</span>
                        <span>Aug</span>
                        <span>Sep</span>
                        <span>Oct</span>
                        <span>Nov</span>
                        <span>Dec</span>
                    </div>

                </div>

            </div>

        </div>


        {{-- System Status --}}
        <div class="cfs-panel">

            <div class="cfs-panel-header">

                <div>
                    <span class="cfs-panel-kicker">
                        {{ __('System') }}
                    </span>

                    <h3>
                        {{ __('System Status') }}
                    </h3>
                </div>

                <span class="cfs-live-status">
                    <span></span>
                    Live
                </span>

            </div>


            <div class="cfs-status-list">

                <div class="cfs-status-item">

                    <span class="cfs-status-icon">
                        <i class="fas fa-microchip"></i>
                    </span>

                    <div class="cfs-status-info">
                        <strong>{{ __('Database') }}</strong>
                        <span>{{ __('Operational') }}</span>
                    </div>

                    <span class="cfs-status-check">
                        <i class="fas fa-circle-check"></i>
                    </span>

                </div>


                <div class="cfs-status-item">

                    <span class="cfs-status-icon">
                        <i class="fas fa-microchip"></i>
                    </span>

                    <div class="cfs-status-info">
                        <strong>{{ __('Application') }}</strong>
                        <span>{{ __('Operational') }}</span>
                    </div>

                    <span class="cfs-status-check">
                        <i class="fas fa-circle-check"></i>
                    </span>

                </div>


                <div class="cfs-status-item">

                    <span class="cfs-status-icon">
                        <i class="fas fa-shield-dog"></i>
                    </span>

                    <div class="cfs-status-info">
                        <strong>{{ __('Security') }}</strong>
                        <span>{{ __('Protected') }}</span>
                    </div>

                    <span class="cfs-status-check">
                        <i class="fas fa-circle-check"></i>
                    </span>

                </div>


                <div class="cfs-status-item">

                    <span class="cfs-status-icon">
                        <i class="fas fa-cloud-arrow-up"></i>
                    </span>

                    <div class="cfs-status-info">
                        <strong>{{ __('Backup') }}</strong>
                        <span>{{ __('Up to date') }}</span>
                    </div>

                    <span class="cfs-status-check">
                        <i class="fas fa-circle-check"></i>
                    </span>

                </div>

            </div>

        </div>

    </section>


    {{-- Quick Access --}}
    <section class="cfs-quick-section">

        <div class="cfs-section-heading">

            <div>
                <span class="cfs-panel-kicker">
                    {{ __('Workspace') }}
                </span>

                <h3>
                    {{ __('Quick Access') }}
                </h3>
            </div>

        </div>


        <div class="cfs-quick-grid">

            @can('view_contracts')

                <a
                    href="{{ route('admin.contracts.index') }}"
                    class="cfs-quick-card"
                >
                    <span class="cfs-quick-icon blue">
                        <i class="fas fa-handshake"></i>
                    </span>

                    <span>
                        <strong>{{ __('Contracts') }}</strong>
                        <small>{{ __('Manage contracts') }}</small>
                    </span>

                    <i class="fas {{ app()->getLocale() === 'ar' ? 'fa-arrow-left' : 'fa-arrow-right' }} cfs-quick-arrow"></i>
                </a>

            @endcan


            @can('view_reports')

                <a
                    href="{{ route('admin.financial-reports.index') }}"
                    class="cfs-quick-card"
                >
                    <span class="cfs-quick-icon purple">
                        <i class="fas fa-vault"></i>
                    </span>

                    <span>
                        <strong>{{ __('Financial Reports') }}</strong>
                        <small>{{ __('Analyze financial data') }}</small>
                    </span>

                    <i class="fas {{ app()->getLocale() === 'ar' ? 'fa-arrow-left' : 'fa-arrow-right' }} cfs-quick-arrow"></i>
                </a>

            @endcan


            <a
                href="{{ route('profile.edit') }}"
                class="cfs-quick-card"
            >
                <span class="cfs-quick-icon amber">
                    <i class="fas fa-user-tie"></i>
                </span>

                <span>
                    <strong>{{ __('Profile') }}</strong>
                    <small>{{ __('Manage your account') }}</small>
                </span>

                <i class="fas {{ app()->getLocale() === 'ar' ? 'fa-arrow-left' : 'fa-arrow-right' }} cfs-quick-arrow"></i>
            </a>

        </div>

    </section>

</div>


@push('styles')

    <style>

        .cfs-dashboard-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .cfs-dashboard-eyebrow {
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

        .cfs-dashboard-eyebrow span {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #059669;
            box-shadow: 0 0 0 4px rgba(5,150,105,.1);
        }

        .cfs-dashboard-title {
            margin: 0;
            font-size: clamp(1.8rem, 3vw, 2.45rem);
            line-height: 1.1;
            font-weight: 800;
            letter-spacing: -.03em;
        }

        .cfs-dashboard-subtitle {
            margin: .55rem 0 0;
            color: var(--cfs-text-2);
            font-size: .92rem;
        }

        .cfs-dashboard-date {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .55rem .8rem;
            border: 1px solid var(--cfs-line);
            border-radius: 999px;
            background: rgba(255,255,255,.8);
            color: var(--cfs-text-2);
            font-size: .75rem;
            font-weight: 600;
        }

        .cfs-dashboard-date i {
            color: var(--cfs-primary);
        }

        .cfs-dashboard {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .cfs-welcome-card {
            position: relative;
            min-height: 245px;
            overflow: hidden;
            display: flex;
            align-items: center;
            padding: 2.25rem 2.5rem;
            border: 1px solid var(--cfs-line);
            border-radius: var(--cfs-radius-xl);
            background: var(--card);
            box-shadow: 0 15px 45px rgba(15,23,42,.07);
        }

        .cfs-welcome-card::after {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
            background:
                radial-gradient(
                    circle at 20% 0%,
                    rgba(14,165,233,.10),
                    transparent 35%
                ),
                radial-gradient(
                    circle at 80% 100%,
                    rgba(217,70,239,.07),
                    transparent 35%
                );
        }

        .cfs-welcome-content {
            position: relative;
            z-index: 2;
            max-width: 700px;
        }

        .cfs-welcome-badge {
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

        .cfs-welcome-badge i {
            color: var(--cfs-primary);
        }

        .cfs-welcome-content h2 {
            margin: 1rem 0 .6rem;
            font-size: clamp(1.6rem, 3vw, 2.3rem);
            line-height: 1.15;
            font-weight: 800;
            letter-spacing: -.03em;
        }

        .cfs-welcome-content p {
            max-width: 620px;
            margin: 0;
            color: var(--cfs-text-2);
            font-size: .9rem;
            line-height: 1.8;
        }

        .cfs-welcome-actions {
            display: flex;
            flex-wrap: wrap;
            gap: .65rem;
            margin-top: 1.4rem;
        }

        .cfs-dashboard-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            padding: .7rem 1rem;
            border-radius: 999px;
            text-decoration: none;
            font-size: .77rem;
            font-weight: 700;
            transition: all .3s var(--cfs-ease);
        }

        .cfs-dashboard-btn.primary {
            color: white;
            background: linear-gradient(
                135deg,
                var(--cfs-primary),
                var(--cfs-primary-dark)
            );
            box-shadow: 0 7px 20px rgba(14,165,233,.25);
        }

        .cfs-dashboard-btn.primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(14,165,233,.35);
        }

        .cfs-dashboard-btn.secondary {
            color: var(--cfs-text);
            border: 1px solid var(--cfs-line-strong);
            background: var(--cfs-card);
        }

        .cfs-dashboard-btn.secondary:hover {
            transform: translateY(-2px);
            border-color: rgba(14,165,233,.3);
            background: rgba(14,165,233,.04);
        }

        .cfs-welcome-visual {
            position: absolute;
            width: 310px;
            height: 310px;
            right: 40px;
            top: 50%;
            transform: translateY(-50%);
        }

        [dir="rtl"] .cfs-welcome-visual {
            right: auto;
            left: 40px;
        }

        .cfs-visual-orb {
            position: absolute;
            inset: 20px;
            border-radius: 50%;
            filter: blur(20px);
        }

        .orb-a {
            background: rgba(14,165,233,.16);
        }

        .orb-b {
            transform: translate(35px, 25px);
            background: rgba(217,70,239,.10);
        }

        .cfs-visual-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            width: 90px;
            height: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 1.7rem;
            color: white;
            background: linear-gradient(
                135deg,
                var(--cfs-primary),
                var(--cfs-primary-dark)
            );
            font-size: 2.1rem;
            box-shadow:
                0 18px 45px rgba(14,165,233,.3),
                0 0 0 12px rgba(14,165,233,.06);
        }

        .cfs-visual-ring {
            position: absolute;
            left: 50%;
            top: 50%;
            border: 1px solid rgba(14,165,233,.18);
            border-radius: 50%;
            transform: translate(-50%,-50%);
        }

        .ring-one {
            width: 170px;
            height: 170px;
        }

        .ring-two {
            width: 245px;
            height: 245px;
            border-color: rgba(217,70,239,.12);
        }

        .cfs-kpi-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 1rem;
        }

        .cfs-kpi-card {
            padding: 1.2rem;
            border: 1px solid var(--cfs-line);
            border-radius: var(--cfs-radius-lg);
            background: rgba(255,255,255,.9);
            box-shadow: 0 5px 18px rgba(15,23,42,.035);
            transition: transform .3s var(--cfs-ease), box-shadow .3s ease;
        }
        .cfs-kpi-card-link {
    display: block;
    color: inherit;
    text-decoration: none;
    cursor: pointer;
}

.cfs-kpi-card-link:hover {
    border-color: rgba(14, 165, 233, .28);
    box-shadow: 0 15px 35px rgba(15, 23, 42, .09);
}

.cfs-kpi-card-link:focus-visible {
    outline: 3px solid rgba(14, 165, 233, .22);
    outline-offset: 3px;
}

.cfs-kpi-card-link .cfs-kpi-value {
    color: var(--cfs-text);
}

        .cfs-kpi-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(15,23,42,.08);
        }

        .cfs-kpi-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .cfs-kpi-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: .8rem;
            font-size: 1rem;
        }

        .cfs-kpi-icon.blue {
            color: var(--cfs-primary);
            background: rgba(14,165,233,.10);
        }

        .cfs-kpi-icon.purple {
            color: var(--cfs-secondary);
            background: rgba(217,70,239,.10);
        }

        .cfs-kpi-icon.amber {
            color: #D97706;
            background: rgba(245,158,11,.11);
        }

        .cfs-kpi-icon.green {
            color: #059669;
            background: rgba(5,150,105,.10);
        }

        .cfs-kpi-trend {
            color: #059669;
            font-size: .7rem;
        }

        .cfs-kpi-label {
            display: block;
            color: var(--cfs-text-3);
            font-size: .72rem;
            font-weight: 600;
        }

        .cfs-kpi-value {
            display: block;
            margin-top: .25rem;
            color: var(--cfs-text);
            font-size: 1.55rem;
            line-height: 1.2;
            font-weight: 800;
            letter-spacing: -.025em;
        }

        .cfs-kpi-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: .5rem;
            margin-top: .8rem;
            color: var(--cfs-text-3);
            font-size: .65rem;
        }

        .cfs-kpi-percent {
            color: #059669;
            font-weight: 700;
        }

        .cfs-dashboard-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.6fr) minmax(300px, .8fr);
            gap: 1.5rem;
        }

        .cfs-panel {
            min-width: 0;
            padding: 1.35rem;
            border: 1px solid var(--cfs-line);
            border-radius: var(--cfs-radius-lg);
            background: rgba(255,255,255,.9);
            box-shadow: 0 5px 20px rgba(15,23,42,.035);
        }

        .cfs-panel-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .cfs-panel-kicker {
            display: block;
            margin-bottom: .2rem;
            color: var(--cfs-primary);
            font-size: .62rem;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .cfs-panel-header h3,
        .cfs-section-heading h3 {
            margin: 0;
            color: var(--cfs-text);
            font-size: 1rem;
            font-weight: 800;
        }

        .cfs-panel-menu {
            width: 32px;
            height: 32px;
            border: 1px solid var(--cfs-line);
            border-radius: 50%;
            background: var(--cfs-card);
            color: var(--cfs-text-3);
            cursor: pointer;
        }

        .cfs-chart {
            display: flex;
            height: 250px;
        }

        .cfs-chart-y {
            width: 40px;
            padding-bottom: 25px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: var(--cfs-text-3);
            font-size: .6rem;
            text-align: start;
        }

        .cfs-chart-area {
            position: relative;
            flex: 1;
            min-width: 0;
        }

        .cfs-chart-grid-lines {
            position: absolute;
            inset: 0 0 25px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .cfs-chart-grid-lines span {
            display: block;
            width: 100%;
            border-top: 1px dashed var(--cfs-line);
        }

        .cfs-bars {
            position: absolute;
            inset: 10px 0 35px;
            display: flex;
            align-items: flex-end;
            gap: .55rem;
            padding-inline: .3rem;
        }

        .cfs-bar {
            flex: 1;
            min-width: 5px;
            border-radius: 6px 6px 2px 2px;
            background: linear-gradient(
                180deg,
                var(--cfs-primary),
                rgba(14,165,233,.16)
            );
            transform-origin: bottom;
            animation: cfsBarRise .8s var(--cfs-ease) both;
        }

        .cfs-bar:nth-child(2n) {
            background: linear-gradient(
                180deg,
                var(--cfs-secondary),
                rgba(217,70,239,.13)
            );
        }

        @keyframes cfsBarRise {
            from {
                transform: scaleY(0);
            }
            to {
                transform: scaleY(1);
            }
        }

        .cfs-chart-labels {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            display: flex;
            justify-content: space-between;
            color: var(--cfs-text-3);
            font-size: .55rem;
        }

        .cfs-live-status {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            color: #059669;
            font-size: .65rem;
            font-weight: 700;
        }

        .cfs-live-status span {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #059669;
            box-shadow: 0 0 0 3px rgba(5,150,105,.10);
        }

        .cfs-status-list {
            display: flex;
            flex-direction: column;
            gap: .7rem;
        }

        .cfs-status-item {
            display: flex;
            align-items: center;
            gap: .65rem;
            padding: .65rem;
            border: 1px solid var(--cfs-line);
            border-radius: .8rem;
            background: var(--cfs-bg);
        }

        .cfs-status-icon {
            width: 34px;
            height: 34px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: .65rem;
            color: var(--cfs-primary);
            background: rgba(14,165,233,.08);
            font-size: .78rem;
        }

        .cfs-status-info {
            min-width: 0;
            flex: 1;
        }

        .cfs-status-info strong,
        .cfs-status-info span {
            display: block;
        }

        .cfs-status-info strong {
            color: var(--cfs-text);
            font-size: .72rem;
        }

        .cfs-status-info span {
            color: var(--cfs-text-3);
            font-size: .6rem;
        }

        .cfs-status-check {
            color: #059669;
            font-size: .75rem;
        }

        .cfs-quick-section {
            margin-top: .25rem;
        }

        .cfs-section-heading {
            margin-bottom: .85rem;
        }

        .cfs-quick-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1rem;
        }

        .cfs-quick-card {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: 1rem;
            border: 1px solid var(--cfs-line);
            border-radius: var(--cfs-radius-lg);
            background: rgba(255,255,255,.88);
            color: var(--cfs-text);
            text-decoration: none;
            transition: all .3s var(--cfs-ease);
        }

        .cfs-quick-card:hover {
            transform: translateY(-3px);
            border-color: rgba(14,165,233,.2);
            box-shadow: 0 12px 30px rgba(15,23,42,.07);
        }

        .cfs-quick-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: .8rem;
        }

        .cfs-quick-icon.blue {
            color: var(--cfs-primary);
            background: rgba(14,165,233,.09);
        }

        .cfs-quick-icon.purple {
            color: var(--cfs-secondary);
            background: rgba(217,70,239,.09);
        }

        .cfs-quick-icon.amber {
            color: #D97706;
            background: rgba(245,158,11,.10);
        }

        .cfs-quick-card > span:nth-child(2) {
            flex: 1;
            min-width: 0;
        }

        .cfs-quick-card strong,
        .cfs-quick-card small {
            display: block;
        }

        .cfs-quick-card strong {
            font-size: .77rem;
        }

        .cfs-quick-card small {
            margin-top: .15rem;
            color: var(--cfs-text-3);
            font-size: .62rem;
        }

        .cfs-quick-arrow {
            color: var(--cfs-text-3);
            font-size: .7rem;
            transition: transform .25s ease;
        }

        .cfs-quick-card:hover .cfs-quick-arrow {
            color: var(--cfs-primary);
            transform: translateX(3px);
        }

        [dir="rtl"] .cfs-quick-card:hover .cfs-quick-arrow {
            transform: translateX(-3px);
        }

        @media (max-width: 1100px) {
            .cfs-kpi-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .cfs-dashboard-grid {
                grid-template-columns: 1fr;
            }

            .cfs-welcome-visual {
                opacity: .45;
            }
        }

        @media (max-width: 768px) {
            .cfs-welcome-card {
                min-height: auto;
                padding: 1.5rem;
            }

            .cfs-welcome-visual {
                display: none;
            }

            .cfs-quick-grid {
                grid-template-columns: 1fr;
            }

            .cfs-chart {
                height: 210px;
            }
        }

        @media (max-width: 560px) {
            .cfs-kpi-grid {
                grid-template-columns: 1fr;
            }

            .cfs-welcome-actions {
                flex-direction: column;
            }

            .cfs-dashboard-btn {
                width: 100%;
            }

            .cfs-chart-y {
                width: 28px;
            }

            .cfs-bars {
                gap: .3rem;
            }

            .cfs-chart-labels span:nth-child(2n) {
                display: none;
            }
        }

    </style>

@endpush


</x-app-layout>
