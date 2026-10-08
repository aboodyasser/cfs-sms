@extends('layouts.app')

@section('title', __('Edit Budget'))

@section('header')
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <div class="mb-2 flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                <a href="{{ route('admin.budgets.index') }}" class="transition hover:text-sky-600">{{ __('Budgets') }}</a>
                <i class="fa-solid fa-chevron-right text-[10px] rtl:rotate-180"></i>
                <span class="text-slate-400">{{ __('Edit Budget') }}</span>
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">
                {{ __('Edit Budget') }}
            </h1>
        </div>
    </div>
@endsection

@section('content')
<div class="py-8 max-w-4xl mx-auto px-4">
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6">
        
        @if ($errors->any())
            <div class="mb-4 rounded-md bg-red-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0"><i class="fa-solid fa-circle-xmark text-red-400"></i></div>
                    <div class="ml-3 rtl:mr-3 rtl:ml-0">
                        <h3 class="text-sm font-medium text-red-800">{{ __('Whoops! Something went wrong.') }}</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc pl-5 rtl:pr-5 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('admin.budgets.update', $budget) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                
                {{-- Project --}}
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Project') }} <span class="text-red-500">*</span>
                    </label>
                    <select name="project_id" required class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                        <option value="">-- {{ __('Select Project') }} --</option>
                        @foreach($projects ?? \App\Models\Project::orderBy('name')->get() as $project)
                            <option value="{{ $project->id }}" {{ old('project_id', $budget->project_id) == $project->id ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Name --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Name / Title') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" required value="{{ old('name', $budget->name) }}" 
                           class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                </div>
                
                {{-- Category --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Category') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="category" required value="{{ old('category', $budget->category) }}" 
                           class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                </div>

                {{-- Allocated Amount --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Allocated Amount') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="number" step="0.01" min="0" name="allocated_amount" required value="{{ old('allocated_amount', $budget->allocated_amount) }}" 
                           class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                </div>
                
                {{-- Status --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Status') }} <span class="text-red-500">*</span>
                    </label>
                    <select name="status" required class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                        <option value="draft" {{ old('status', $budget->status) == 'draft' ? 'selected' : '' }}>{{ __('Draft') }}</option>
                        <option value="active" {{ old('status', $budget->status) == 'active' ? 'selected' : '' }}>{{ __('Active') }}</option>
                        <option value="closed" {{ old('status', $budget->status) == 'closed' ? 'selected' : '' }}>{{ __('Closed') }}</option>
                    </select>
                </div>

                {{-- Description --}}
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Description') }}
                    </label>
                    <textarea name="description" rows="3" 
                              class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">{{ old('description', $budget->description) }}</textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6 border-t border-slate-200 dark:border-slate-700 pt-6">
                <a href="{{ route('admin.budgets.index') }}" class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700">
                    {{ __('Cancel') }}
                </a>
                <button type="submit" class="px-4 py-2 bg-sky-600 text-white rounded-lg hover:bg-sky-700">
                    <i class="fa-solid fa-save mr-1 rtl:ml-1"></i> {{ __('Update') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection