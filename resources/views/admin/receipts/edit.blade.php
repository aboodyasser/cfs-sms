@extends('layouts.app')

@section('title', __('Create Receipt'))

@section('content')
<div class="py-8 max-w-4xl mx-auto px-4">
    <div class="mb-6">
        <h1 class="text-2xl font-bold dark:text-white">{{ __('Edit Receipt') }}: {{ $receipt->id }}</h1>
    </div>
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6">
        <form action="{{ route('admin.receipts.update', $receipt) }}" method="POST">
            @method('PUT')>
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                
                {{-- Title --}}
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Title') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" required value="{{ old('title', $receipt->title) }}" 
                           class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                </div>

                {{-- Amount --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Amount') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="number" step="0.01" name="amount" required value="{{ old('amount', $receipt->amount) }}" 
                           class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                </div>

                {{-- Receipt Date --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Date') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="receipt_date" required value="{{ old('receipt_date', date('Y-m-d')) }}" 
                           class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                </div>

                {{-- Source --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Source') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="source" required value="{{ old('source', $receipt->source) }}" 
                           class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Status') }} <span class="text-red-500">*</span>
                    </label>
                    <select name="status" required class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                        <option value="draft" {{ old('status', $receipt->status) == 'draft' ? 'selected' : '' }}>{{ __('Draft') }}</option>
                        <option value="completed" {{ old('status', $receipt->status) == 'completed' ? 'selected' : '' }}>{{ __('Completed') }}</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button type="submit" class="px-4 py-2 bg-sky-600 text-white rounded-lg hover:bg-sky-700">
                    {{ __('Update') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection