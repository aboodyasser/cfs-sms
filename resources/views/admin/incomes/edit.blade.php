@extends('layouts.app')

@section('title', __('Edit Income'))

@section('header')
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <div class="mb-2 flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                <a href="{{ route('admin.incomes.index') }}" class="transition hover:text-sky-600">{{ __('Incomes') }}</a>
                <i class="fa-solid fa-chevron-right text-[10px] rtl:rotate-180"></i>
                <a href="{{ route('admin.incomes.show', $income) }}" class="transition hover:text-sky-600">{{ $income->income_number }}</a>
                <i class="fa-solid fa-chevron-right text-[10px] rtl:rotate-180"></i>
                <span class="text-slate-400">{{ __('Edit') }}</span>
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">
                {{ __('Edit Income') }}: {{ $income->income_number }}
            </h1>
        </div>
    </div>
@endsection

@section('content')
<div class="py-8 max-w-4xl mx-auto px-4">
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6">
        <form action="{{ route('admin.incomes.update', $income) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                
                {{-- Title --}}
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Title') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" required value="{{ old('title', $income->title) }}" 
                           class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                </div>

                {{-- Amount --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Amount') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="number" step="0.01" name="amount" required value="{{ old('amount', $income->amount) }}" 
                           class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                </div>

                {{-- Income Date --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Date') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="income_date" required value="{{ old('income_date', \Carbon\Carbon::parse($income->income_date)->format('Y-m-d')) }}" 
                           class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                </div>

                {{-- Source --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Source') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="source" required value="{{ old('source', $income->source) }}" 
                           class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Status') }} <span class="text-red-500">*</span>
                    </label>
                    <select name="status" required class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                        <option value="draft" {{ old('status', $income->status) == 'draft' ? 'selected' : '' }}>{{ __('Draft') }}</option>
                        <option value="submitted" {{ old('status', $income->status) == 'submitted' ? 'selected' : '' }}>{{ __('Submitted') }}</option>
                    </select>
                </div>

                {{-- Project ID --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Project') }}
                    </label>
                    <select name="project_id" class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                        <option value="">-- {{ __('Select Project') }} --</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ old('project_id', $income->project_id) == $project->id ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Reference Number --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Reference Number') }}
                    </label>
                    <input type="text" name="reference_number" value="{{ old('reference_number', $income->reference_number) }}" 
                           class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                </div>

                {{-- Description --}}
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Description') }}
                    </label>
                    <textarea name="description" rows="3" 
                              class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">{{ old('description', $income->description) }}</textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <a href="{{ route('admin.incomes.show', $income) }}" class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700">
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