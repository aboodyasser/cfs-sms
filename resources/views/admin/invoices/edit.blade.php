@extends('layouts.app')

@section('title', __('Create Invoice'))

@section('header')
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <div class="mb-2 flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                <a href="{{ route('admin.invoices.index') }}" class="transition hover:text-sky-600">{{ __('Invoices') }}</a>
                <i class="fa-solid fa-chevron-right text-[10px] rtl:rotate-180"></i>
                <span class="text-slate-400">{{ __('Edit Invoice') }}: {{ $invoice->id }}</span>
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">
                {{ __('Edit Invoice') }}: {{ $invoice->id }}
            </h1>
        </div>
    </div>
@endsection

@section('content')
<div class="py-8 max-w-4xl mx-auto px-4">
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6">
        <form action="{{ route('admin.invoices.update', $invoice) }}" method="POST">
            @method('PUT')>
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                
                {{-- Title --}}
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Title') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" required value="{{ old('title', $invoice->title) }}" 
                           class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                </div>

                {{-- Vendor --}}
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Vendor') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="vendor" required value="{{ old('vendor', $invoice->vendor) }}" 
                           class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                </div>

                {{-- Subtotal --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Subtotal') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="number" step="0.01" name="subtotal" required value="{{ old('subtotal', $invoice->subtotal) }}" 
                           class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                </div>

                {{-- Tax Amount --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Tax Amount') }}
                    </label>
                    <input type="number" step="0.01" name="tax_amount" value="{{ old('tax_amount', $invoice->tax_amount) }}" 
                           class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                </div>

                {{-- Invoice Date --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Invoice Date') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="invoice_date" required value="{{ old('invoice_date', date('Y-m-d')) }}" 
                           class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                </div>

                {{-- Due Date --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Due Date') }}
                    </label>
                    <input type="date" name="due_date" value="{{ old('due_date', $invoice->due_date) }}" 
                           class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                </div>

                {{-- Project --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Project') }}
                    </label>
                    <select name="project_id" class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                        <option value="">-- {{ __('Select Project') }} --</option>
                        @foreach($projects ?? [] as $project)
                            <option value="{{ $project->id }}" {{ old('project_id', $invoice->project_id) == $project->id ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                {{-- Status --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Status') }} <span class="text-red-500">*</span>
                    </label>
                    <select name="status" required class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                        <option value="draft" {{ old('status', $invoice->status) == 'draft' ? 'selected' : '' }}>{{ __('Draft') }}</option>
                        <option value="submitted" {{ old('status', $invoice->status) == 'submitted' ? 'selected' : '' }}>{{ __('Submitted') }}</option>
                    </select>
                </div>

                {{-- Description --}}
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Description') }}
                    </label>
                    <textarea name="description" rows="3" 
                              class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">{{ old('description', $invoice->description) }}</textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <a href="{{ route('admin.invoices.index') }}" class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700">
                    {{ __('Cancel') }}
                </a>
                <button type="submit" class="px-4 py-2 bg-sky-600 text-white rounded-lg hover:bg-sky-700">
                    {{ __('Update') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection