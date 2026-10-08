@extends('layouts.app')

@section('title', __('System Command Center & Quick Map'))

@section('header')
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="font-bold text-2xl text-gray-900 tracking-tight flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center text-lg shadow-md shadow-indigo-200">
                    <i class="fas fa-network-wired"></i>
                </div>
                <span>{{ __('System Command Center & Complete Map') }}</span>
            </h2>
            <p class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500 mt-1">
                {{ __('Full administrative overview and direct routing map for all SmartERP institutional modules.') }}
            </p>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-3 py-1 bg-emerald-50 text-emerald-700 rounded-full text-xs font-semibold border border-emerald-200">
                <i class="fas fa-shield-alt mr-1"></i> {{ auth()->user()->hasRole('Super Admin') ? __('Super Admin Privilege Active') : __('User Privilege Active') }}
            </span>
        </div>
    </div>
@endsection

@section('content')
<div class="py-6 space-y-8" x-data="{ searchQuery: '' }">

    {{-- ترحيب وتنبيه مع شريط البحث --}}
    <div class="bg-gradient-to-r from-indigo-900 to-slate-900 text-white rounded-3xl p-8 shadow-2xl relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl"></div>
        <div class="absolute -left-10 -top-10 w-40 h-40 bg-sky-500/20 rounded-full blur-2xl"></div>
        
        <div class="relative z-10 flex-1">
            <h3 class="text-2xl font-bold mb-2 flex items-center gap-2">
                <i class="fas fa-satellite-dish text-indigo-300"></i>
                {{ __('Welcome back') }}, {{ auth()->user()->name }}
            </h3>
            <p class="text-sm text-indigo-100/80 max-w-2xl leading-relaxed">
                {{ __('This central map gives you total visibility and instant navigation across every subsystem, workflow, and CRUD module deployed in the CFS Smart Management System. Choose any module below to manage data or audit operations.') }}
            </p>
        </div>

        <div class="relative z-10 w-full md:w-1/3">
            <div class="relative">
                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-indigo-300">
                    <i class="fas fa-search"></i>
                </div>
                <input 
                    type="text" 
                    x-model="searchQuery" 
                    placeholder="{{ __('Search for a module or section...') }}"
                    class="block w-full pr-12 pl-4 py-3 bg-white dark:bg-slate-800/10 border border-white/20 rounded-xl text-white placeholder-indigo-200/70 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:bg-white dark:bg-slate-800/20 transition backdrop-blur-sm shadow-inner"
                >
                <button 
                    x-show="searchQuery.length > 0" 
                    @click="searchQuery = ''"
                    class="absolute inset-y-0 left-0 flex items-center pl-4 text-indigo-300 hover:text-white transition"
                    style="display: none;"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- شبكة الأقسام المجمعة --}}
    <div class="space-y-10">

        {{-- 1. Administration & Security --}}
        @canany(['view_users', 'manage_users', 'view_roles', 'manage_roles', 'view_audit_logs'])
        <div class="system-section" x-show="searchQuery === '' || $el.innerText.toLowerCase().includes(searchQuery.toLowerCase())">
            <div class="flex items-center gap-3 mb-5 border-b border-gray-100 pb-3">
                <div class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 flex items-center justify-center">
                    <i class="fas fa-shield-halved"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">{{ __('Administration & Security') }}</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- إدارة المستخدمين --}}
                @canany(['view_users', 'manage_users'])
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 p-6 flex flex-col justify-between transition-all duration-300 group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center text-xl group-hover:bg-sky-600 group-hover:text-white transition-colors">
                                <i class="fas fa-users"></i>
                            </div>
                            <span class="text-[10px] font-bold px-2.5 py-1 bg-sky-50 text-sky-700 rounded-lg border border-sky-100">{{ __('Users Hub') }}</span>
                        </div>
                        <h4 class="font-bold text-gray-900 text-lg mb-2">{{ __('Users Management') }}</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500 mb-6 leading-relaxed">{{ __('Manage system accounts, activation states, assignments, and credentials.') }}</p>
                    </div>
                    <div class="pt-4 border-t border-gray-50 flex items-center justify-between">
                        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-sky-600 hover:text-sky-800 transition">
                            <span>{{ __('View All') }}</span>
                            <i class="fas fa-arrow-left text-[10px] rtl:rotate-180"></i>
                        </a>
                        @can('create_user')
                        <a href="{{ route('admin.users.create') }}" class="w-8 h-8 rounded-full bg-sky-50 text-sky-600 flex items-center justify-center hover:bg-sky-100 transition tooltip" title="{{ __('Add New') }}">
                            <i class="fas fa-plus"></i>
                        </a>
                        @endcan
                    </div>
                </div>
                @endcanany

                {{-- الأدوار والصلاحيات --}}
                @canany(['view_roles', 'manage_roles'])
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 p-6 flex flex-col justify-between transition-all duration-300 group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center text-xl group-hover:bg-purple-600 group-hover:text-white transition-colors">
                                <i class="fas fa-user-shield"></i>
                            </div>
                            <span class="text-[10px] font-bold px-2.5 py-1 bg-purple-50 text-purple-700 rounded-lg border border-purple-100">{{ __('Spatie RBAC') }}</span>
                        </div>
                        <h4 class="font-bold text-gray-900 text-lg mb-2">{{ __('Roles & Permissions') }}</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500 mb-6 leading-relaxed">{{ __('Configure access control matrices, roles, and granular permissions.') }}</p>
                    </div>
                    <div class="pt-4 border-t border-gray-50 flex items-center justify-between">
                        <a href="{{ route('admin.roles.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-purple-600 hover:text-purple-800 transition">
                            <span>{{ __('Manage Roles') }}</span>
                            <i class="fas fa-arrow-left text-[10px] rtl:rotate-180"></i>
                        </a>
                        @can('manage_roles')
                        <a href="{{ route('admin.roles.create') }}" class="w-8 h-8 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center hover:bg-purple-100 transition tooltip" title="{{ __('Add New') }}">
                            <i class="fas fa-plus"></i>
                        </a>
                        @endcan
                    </div>
                </div>
                @endcanany

                {{-- سجلات التدقيق --}}
                @can('view_audit_logs')
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 p-6 flex flex-col justify-between transition-all duration-300 group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-slate-50 dark:bg-slate-900 text-slate-600 dark:text-slate-300 flex items-center justify-center text-xl group-hover:bg-slate-600 group-hover:text-white transition-colors">
                                <i class="fas fa-history"></i>
                            </div>
                            <span class="text-[10px] font-bold px-2.5 py-1 bg-slate-50 dark:bg-slate-900 text-slate-700 rounded-lg border border-slate-200 dark:border-slate-700">{{ __('Security') }}</span>
                        </div>
                        <h4 class="font-bold text-gray-900 text-lg mb-2">{{ __('Audit Logs & Tracking') }}</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500 mb-6 leading-relaxed">{{ __('Monitor administrative actions, system events, and security tracking logs.') }}</p>
                    </div>
                    <div class="pt-4 border-t border-gray-50">
                        <a href="{{ route('admin.audit-logs.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 dark:text-slate-300 hover:text-slate-800 dark:text-slate-200 transition w-full justify-between bg-slate-50 dark:bg-slate-900 px-4 py-2 rounded-xl">
                            <span>{{ __('View Audit Trails') }}</span>
                            <i class="fas fa-arrow-left text-[10px] rtl:rotate-180"></i>
                        </a>
                    </div>
                </div>
                @endcan
            </div>
        </div>
        @endcanany

        {{-- 2. Human Resources & Structure --}}
        @canany(['view_departments', 'manage_departments', 'view_positions', 'manage_positions'])
        <div class="system-section" x-show="searchQuery === '' || $el.innerText.toLowerCase().includes(searchQuery.toLowerCase())">
            <div class="flex items-center gap-3 mb-5 border-b border-gray-100 pb-3 mt-8">
                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                    <i class="fas fa-sitemap"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">{{ __('Human Resources & Structure') }}</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- الأقسام الهيكلية --}}
                @canany(['view_departments', 'manage_departments'])
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 p-6 flex flex-col justify-between transition-all duration-300 group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                <i class="fas fa-building"></i>
                            </div>
                            <span class="text-[10px] font-bold px-2.5 py-1 bg-blue-50 text-blue-700 rounded-lg border border-blue-100">{{ __('Structure') }}</span>
                        </div>
                        <h4 class="font-bold text-gray-900 text-lg mb-2">{{ __('Departments') }}</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500 mb-6 leading-relaxed">{{ __('Institutional departments, operational units, and status controls.') }}</p>
                    </div>
                    <div class="pt-4 border-t border-gray-50 flex items-center justify-between">
                        <a href="{{ route('admin.departments.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-800 transition">
                            <span>{{ __('View All') }}</span>
                            <i class="fas fa-arrow-left text-[10px] rtl:rotate-180"></i>
                        </a>
                        @can('manage_departments')
                        <a href="{{ route('admin.departments.create') }}" class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-100 transition tooltip" title="{{ __('Add New') }}">
                            <i class="fas fa-plus"></i>
                        </a>
                        @endcan
                    </div>
                </div>
                @endcanany

                {{-- المسميات الوظيفية --}}
                @canany(['view_positions', 'manage_positions'])
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 p-6 flex flex-col justify-between transition-all duration-300 group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl group-hover:bg-amber-600 group-hover:text-white transition-colors">
                                <i class="fas fa-id-badge"></i>
                            </div>
                            <span class="text-[10px] font-bold px-2.5 py-1 bg-amber-50 text-amber-700 rounded-lg border border-amber-100">{{ __('HR Hub') }}</span>
                        </div>
                        <h4 class="font-bold text-gray-900 text-lg mb-2">{{ __('Positions & Titles') }}</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500 mb-6 leading-relaxed">{{ __('Manage job titles, hierarchies, and staff position assignments.') }}</p>
                    </div>
                    <div class="pt-4 border-t border-gray-50 flex items-center justify-between">
                        <a href="{{ route('admin.positions.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-amber-600 hover:text-amber-800 transition">
                            <span>{{ __('View All') }}</span>
                            <i class="fas fa-arrow-left text-[10px] rtl:rotate-180"></i>
                        </a>
                        @can('manage_positions')
                        <a href="{{ route('admin.positions.create') }}" class="w-8 h-8 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center hover:bg-amber-100 transition tooltip" title="{{ __('Add New') }}">
                            <i class="fas fa-plus"></i>
                        </a>
                        @endcan
                    </div>
                </div>
                @endcanany
            </div>
        </div>
        @endcanany

        {{-- 3. Operations & Management --}}
        @canany(['view_projects', 'create_project', 'view_contracts', 'create_contract', 'view_documents', 'upload_document'])
        <div class="system-section" x-show="searchQuery === '' || $el.innerText.toLowerCase().includes(searchQuery.toLowerCase())">
            <div class="flex items-center gap-3 mb-5 border-b border-gray-100 pb-3 mt-8">
                <div class="w-8 h-8 rounded-lg bg-teal-50 text-teal-600 flex items-center justify-center">
                    <i class="fas fa-tasks"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">{{ __('Operations & Management') }}</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- إدارة المشاريع --}}
                @canany(['view_projects', 'create_project'])
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 p-6 flex flex-col justify-between transition-all duration-300 group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center text-xl group-hover:bg-teal-600 group-hover:text-white transition-colors">
                                <i class="fas fa-project-diagram"></i>
                            </div>
                            <span class="text-[10px] font-bold px-2.5 py-1 bg-teal-50 text-teal-700 rounded-lg border border-teal-100">{{ __('Core') }}</span>
                        </div>
                        <h4 class="font-bold text-gray-900 text-lg mb-2">{{ __('Projects Management') }}</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500 mb-6 leading-relaxed">{{ __('Track project budgets, burn rates, timelines, and status lifecycle.') }}</p>
                    </div>
                    <div class="pt-4 border-t border-gray-50 flex items-center justify-between">
                        <a href="{{ route('admin.projects.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-teal-600 hover:text-teal-800 transition">
                            <span>{{ __('View All') }}</span>
                            <i class="fas fa-arrow-left text-[10px] rtl:rotate-180"></i>
                        </a>
                        @can('create_project')
                        <a href="{{ route('admin.projects.create') }}" class="w-8 h-8 rounded-full bg-teal-50 text-teal-600 flex items-center justify-center hover:bg-teal-100 transition tooltip" title="{{ __('Add New') }}">
                            <i class="fas fa-plus"></i>
                        </a>
                        @endcan
                    </div>
                </div>
                @endcanany

                {{-- إدارة العقود --}}
                @canany(['view_contracts', 'create_contract'])
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 p-6 flex flex-col justify-between transition-all duration-300 group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                                <i class="fas fa-file-contract"></i>
                            </div>
                            <span class="text-[10px] font-bold px-2.5 py-1 bg-indigo-50 text-indigo-700 rounded-lg border border-indigo-100">{{ __('Workflow') }}</span>
                        </div>
                        <h4 class="font-bold text-gray-900 text-lg mb-2">{{ __('Contracts & Attachments') }}</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500 mb-6 leading-relaxed">{{ __('Draft, review, approve contracts, and manage secure file attachments.') }}</p>
                    </div>
                    <div class="pt-4 border-t border-gray-50 flex items-center justify-between">
                        <a href="{{ route('admin.contracts.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-indigo-600 hover:text-indigo-800 transition">
                            <span>{{ __('View All') }}</span>
                            <i class="fas fa-arrow-left text-[10px] rtl:rotate-180"></i>
                        </a>
                        @can('create_contract')
                        <a href="{{ route('admin.contracts.create') }}" class="w-8 h-8 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center hover:bg-indigo-100 transition tooltip" title="{{ __('Add New') }}">
                            <i class="fas fa-plus"></i>
                        </a>
                        @endcan
                    </div>
                </div>
                @endcanany

                {{-- الأرشيف الإلكتروني --}}
                @canany(['view_documents', 'upload_document'])
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 p-6 flex flex-col justify-between transition-all duration-300 group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-pink-50 text-pink-600 flex items-center justify-center text-xl group-hover:bg-pink-600 group-hover:text-white transition-colors">
                                <i class="fas fa-archive"></i>
                            </div>
                            <span class="text-[10px] font-bold px-2.5 py-1 bg-pink-50 text-pink-700 rounded-lg border border-pink-100">{{ __('Archiving') }}</span>
                        </div>
                        <h4 class="font-bold text-gray-900 text-lg mb-2">{{ __('Electronic Archiving') }}</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500 mb-6 leading-relaxed">{{ __('Secure document repository, category filtering, and file management.') }}</p>
                    </div>
                    <div class="pt-4 border-t border-gray-50 flex items-center justify-between">
                        <a href="{{ route('admin.documents.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-pink-600 hover:text-pink-800 transition">
                            <span>{{ __('View All') }}</span>
                            <i class="fas fa-arrow-left text-[10px] rtl:rotate-180"></i>
                        </a>
                        @can('upload_document')
                        <a href="{{ route('admin.documents.create') }}" class="w-8 h-8 rounded-full bg-pink-50 text-pink-600 flex items-center justify-center hover:bg-pink-100 transition tooltip" title="{{ __('Add New') }}">
                            <i class="fas fa-upload"></i>
                        </a>
                        @endcan
                    </div>
                </div>
                @endcanany
            </div>
        </div>
        @endcanany

        {{-- 4. Financial Management --}}
        @canany(['view_budgets', 'create_budget', 'view_incomes', 'create_income', 'approve_expense', 'create_expense', 'edit_expense', 'submit_expense', 'review_expense', 'reject_expense', 'view_invoices', 'create_invoice', 'view_payments', 'create_payment', 'view_receipts', 'create_receipt', 'view_reports', 'reports.export', 'export_reports'])
        <div class="system-section" x-show="searchQuery === '' || $el.innerText.toLowerCase().includes(searchQuery.toLowerCase())">
            <div class="flex items-center gap-3 mb-5 border-b border-gray-100 pb-3 mt-8">
                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <i class="fas fa-coins"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">{{ __('Financial Management') }}</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- الموازنات --}}
                @canany(['view_budgets', 'create_budget'])
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 p-6 flex flex-col justify-between transition-all duration-300 group lg:col-span-2">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                                    <i class="fas fa-wallet"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-lg">{{ __('Budgets Management') }}</h4>
                                    <span class="text-[10px] font-bold px-2 py-0.5 bg-emerald-50 text-emerald-700 rounded-md border border-emerald-100">{{ __('Finance') }}</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500 mb-6 leading-relaxed">{{ __('Institutional budgets, allocations, and financial utilization tracking.') }}</p>
                    </div>
                    <div class="pt-4 border-t border-gray-50 flex items-center justify-between">
                        <a href="{{ route('admin.budgets.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-emerald-600 hover:text-emerald-800 transition">
                            <span>{{ __('View All') }}</span>
                            <i class="fas fa-arrow-left text-[10px] rtl:rotate-180"></i>
                        </a>
                        @can('create_budget')
                        <a href="{{ route('admin.budgets.create') }}" class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center hover:bg-emerald-100 transition tooltip" title="{{ __('Add New') }}">
                            <i class="fas fa-plus"></i>
                        </a>
                        @endcan
                    </div>
                </div>
                @endcanany

                {{-- الإيرادات --}}
                @canany(['view_incomes', 'create_income'])
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 p-6 flex flex-col justify-between transition-all duration-300 group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center text-lg group-hover:bg-cyan-600 group-hover:text-white transition-colors">
                                <i class="fas fa-hand-holding-usd"></i>
                            </div>
                        </div>
                        <h4 class="font-bold text-gray-900 text-base mb-1">{{ __('Incomes') }}</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500 mb-4 leading-relaxed line-clamp-2">{{ __('Track donor funds and grants.') }}</p>
                    </div>
                    <div class="pt-3 border-t border-gray-50 flex items-center justify-between">
                        <a href="{{ route('admin.incomes.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-cyan-600 hover:text-cyan-800 transition">
                            <span>{{ __('View All') }}</span>
                        </a>
                        @can('create_income')
                        <a href="{{ route('admin.incomes.create') }}" class="w-7 h-7 rounded-full bg-cyan-50 text-cyan-600 flex items-center justify-center hover:bg-cyan-100 transition text-xs">
                            <i class="fas fa-plus"></i>
                        </a>
                        @endcan
                    </div>
                </div>
                @endcanany

                {{-- النفقات --}}
                @canany(['approve_expense', 'create_expense', 'edit_expense', 'submit_expense', 'review_expense', 'reject_expense'])
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 p-6 flex flex-col justify-between transition-all duration-300 group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-lg group-hover:bg-rose-600 group-hover:text-white transition-colors">
                                <i class="fas fa-file-invoice-dollar"></i>
                            </div>
                        </div>
                        <h4 class="font-bold text-gray-900 text-base mb-1">{{ __('Expenses') }}</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500 mb-4 leading-relaxed line-clamp-2">{{ __('Organizational expenditures.') }}</p>
                    </div>
                    <div class="pt-3 border-t border-gray-50 flex items-center justify-between">
                        <a href="{{ route('admin.expenses.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-rose-600 hover:text-rose-800 transition">
                            <span>{{ __('View All') }}</span>
                        </a>
                        @can('create_expense')
                        <a href="{{ route('admin.expenses.create') }}" class="w-7 h-7 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center hover:bg-rose-100 transition text-xs">
                            <i class="fas fa-plus"></i>
                        </a>
                        @endcan
                    </div>
                </div>
                @endcanany

                {{-- الفواتير --}}
                @canany(['view_invoices', 'create_invoice'])
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 p-6 flex flex-col justify-between transition-all duration-300 group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center text-lg group-hover:bg-orange-600 group-hover:text-white transition-colors">
                                <i class="fas fa-receipt"></i>
                            </div>
                        </div>
                        <h4 class="font-bold text-gray-900 text-base mb-1">{{ __('Invoices') }}</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500 mb-4 leading-relaxed line-clamp-2">{{ __('Manage billing workflows.') }}</p>
                    </div>
                    <div class="pt-3 border-t border-gray-50 flex items-center justify-between">
                        <a href="{{ route('admin.invoices.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-orange-600 hover:text-orange-800 transition">
                            <span>{{ __('View All') }}</span>
                        </a>
                        @can('create_invoice')
                        <a href="{{ route('admin.invoices.create') }}" class="w-7 h-7 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center hover:bg-orange-100 transition text-xs">
                            <i class="fas fa-plus"></i>
                        </a>
                        @endcan
                    </div>
                </div>
                @endcanany

                {{-- المدفوعات والإيصالات --}}
                @canany(['view_payments', 'create_payment', 'view_receipts', 'create_receipt'])
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 p-6 flex flex-col justify-between transition-all duration-300 group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-10 h-10 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center text-lg group-hover:bg-violet-600 group-hover:text-white transition-colors">
                                <i class="fas fa-money-check-alt"></i>
                            </div>
                        </div>
                        <h4 class="font-bold text-gray-900 text-base mb-1">{{ __('Transactions') }}</h4>
                        <p class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500 mb-4 leading-relaxed line-clamp-2">{{ __('Payments and official receipts.') }}</p>
                    </div>
                    <div class="pt-3 border-t border-gray-50 flex items-center gap-3">
                        @canany(['view_payments', 'create_payment'])
                        <a href="{{ route('admin.payments.index') }}" class="inline-flex items-center justify-center flex-1 py-1.5 bg-violet-50 hover:bg-violet-100 text-violet-700 text-xs font-medium rounded-lg transition">
                            {{ __('Payments') }}
                        </a>
                        @endcanany
                        @canany(['view_receipts', 'create_receipt'])
                        <a href="{{ route('admin.receipts.index') }}" class="inline-flex items-center justify-center flex-1 py-1.5 bg-violet-50 hover:bg-violet-100 text-violet-700 text-xs font-medium rounded-lg transition">
                            {{ __('Receipts') }}
                        </a>
                        @endcanany
                    </div>
                </div>
                @endcanany

                {{-- التقارير المالية --}}
                @canany(['view_reports', 'reports.export', 'export_reports'])
                <div class="bg-white dark:bg-slate-800 rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 p-6 flex flex-col justify-between transition-all duration-300 group lg:col-span-2">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-2xl bg-lime-50 text-lime-600 flex items-center justify-center text-xl group-hover:bg-lime-600 group-hover:text-white transition-colors">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 text-lg">{{ __('Financial Reports') }}</h4>
                                    <span class="text-[10px] font-bold px-2 py-0.5 bg-lime-50 text-lime-700 rounded-md border border-lime-100">{{ __('Analytics') }}</span>
                                </div>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500 mb-6 leading-relaxed">{{ __('Comprehensive institutional summaries, balance sheets, and data exports.') }}</p>
                    </div>
                    <div class="pt-4 border-t border-gray-50">
                        <a href="{{ route('admin.financial-reports.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-lime-700 hover:text-lime-900 transition w-full justify-between bg-lime-50 hover:bg-lime-100 px-4 py-2 rounded-xl">
                            <span>{{ __('Open Financial Reports') }}</span>
                            <i class="fas fa-arrow-left text-[10px] rtl:rotate-180"></i>
                        </a>
                    </div>
                </div>
                @endcanany
            </div>
        </div>
        @endcanany
        
    </div>
</div>

<style>
    /* Tooltip styles */
    .tooltip {
        position: relative;
    }
    .tooltip::before {
        content: attr(title);
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        margin-bottom: 8px;
        padding: 4px 8px;
        background-color: #1e293b;
        color: white;
        font-size: 10px;
        border-radius: 4px;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all 0.2s;
        z-index: 10;
        pointer-events: none;
    }
    .tooltip::after {
        content: '';
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        margin-bottom: 4px;
        border-width: 4px;
        border-style: solid;
        border-color: #1e293b transparent transparent transparent;
        opacity: 0;
        visibility: hidden;
        transition: all 0.2s;
        z-index: 10;
        pointer-events: none;
    }
    .tooltip:hover::before,
    .tooltip:hover::after {
        opacity: 1;
        visibility: visible;
    }
</style>
@endsection
