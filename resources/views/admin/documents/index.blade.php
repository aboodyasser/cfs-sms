<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Documents') }}
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500 mt-1">
                    {{ __('Manage and archive organizational documents.') }}
                </p>
            </div>

            @can('upload_document')
                <a
                    href="{{ route('admin.documents.create') }}"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gray-900 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition"
                >
                    <svg
                        class="w-4 h-4"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 4v16m8-8H4"
                        />
                    </svg>

                    {{ __('Upload Document') }}
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if(session('success'))
                <div class="mb-6 rounded-lg bg-green-50 border border-green-200 p-4">
                    <div class="flex items-center gap-3 text-green-700">
                        <svg
                            class="w-5 h-5 flex-shrink-0"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>

                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            {{-- Error Message --}}
            @if(session('error'))
                <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4">
                    <div class="flex items-center gap-3 text-red-700">
                        <svg
                            class="w-5 h-5 flex-shrink-0"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>

                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            {{-- Statistics --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">

                {{-- Total Documents --}}
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 dark:text-gray-500">
                                {{ __('Total Documents') }}
                            </p>

                            <p class="text-2xl font-bold text-gray-900 mt-2">
                                {{ $documents->total() }}
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-lg bg-blue-50 flex items-center justify-center">
                            <svg
                                class="w-6 h-6 text-blue-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M7 3h7l5 5v13H7a2 2 0 01-2-2V5a2 2 0 012-2z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M14 3v6h6"
                                />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Current Page --}}
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 dark:text-gray-500">
                                {{ __('Showing') }}
                            </p>

                            <p class="text-2xl font-bold text-gray-900 mt-2">
                                {{ $documents->count() }}
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-lg bg-green-50 flex items-center justify-center">
                            <svg
                                class="w-6 h-6 text-green-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M5 13l4 4L19 7"
                                />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- First Result --}}
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 dark:text-gray-500">
                                {{ __('First Result') }}
                            </p>

                            <p class="text-2xl font-bold text-gray-900 mt-2">
                                {{ $documents->firstItem() ?? 0 }}
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-lg bg-indigo-50 flex items-center justify-center">
                            <svg
                                class="w-6 h-6 text-indigo-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 7v10m0 0l-3-3m3 3l3-3M16 7v10m0 0l-3-3m3 3l3-3"
                                />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Last Result --}}
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-gray-100 p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400 dark:text-gray-500">
                                {{ __('Last Result') }}
                            </p>

                            <p class="text-2xl font-bold text-gray-900 mt-2">
                                {{ $documents->lastItem() ?? 0 }}
                            </p>
                        </div>

                        <div class="w-11 h-11 rounded-lg bg-purple-50 flex items-center justify-center">
                            <svg
                                class="w-6 h-6 text-purple-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M9 5l7 7-7 7"
                                />
                            </svg>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Main Card --}}
            <div class="bg-white dark:bg-slate-800 shadow-sm border border-gray-100 rounded-xl overflow-hidden">

                {{-- Filters --}}
                <div class="p-6 border-b border-gray-100 bg-gray-50 dark:bg-slate-900/50">

                    <form
                        method="GET"
                        action="{{ route('admin.documents.index') }}"
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4"
                    >

                        {{-- Search --}}
                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                {{ __('Search') }}
                            </label>

                            <input
                                type="text"
                                name="q"
                                value="{{ request('q') }}"
                                placeholder="{{ __('Title, document number, file name...') }}"
                                class="w-full rounded-lg border-gray-300 focus:border-gray-500 focus:ring-gray-500"
                            >
                        </div>

                        {{-- Category --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                {{ __('Category') }}
                            </label>

                            <input
                                type="text"
                                name="category"
                                value="{{ request('category') }}"
                                placeholder="{{ __('Category') }}"
                                class="w-full rounded-lg border-gray-300 focus:border-gray-500 focus:ring-gray-500"
                            >
                        </div>

                        {{-- Project --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                {{ __('Project') }}
                            </label>

                            <select
                                name="project_id"
                                class="w-full rounded-lg border-gray-300 focus:border-gray-500 focus:ring-gray-500"
                            >
                                <option value="">
                                    {{ __('All Projects') }}
                                </option>

                                @foreach($projects as $project)
                                    <option
                                        value="{{ $project->id }}"
                                        @selected((string) request('project_id') === (string) $project->id)
                                    >
                                        {{ $project->code }} - {{ $project->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Status --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                {{ __('Status') }}
                            </label>

                            <select
                                name="status"
                                class="w-full rounded-lg border-gray-300 focus:border-gray-500 focus:ring-gray-500"
                            >
                                <option value="">
                                    {{ __('All') }}
                                </option>

                                <option
                                    value="active"
                                    @selected(request('status') === 'active')
                                >
                                    {{ __('Active') }}
                                </option>

                                <option
                                    value="archived"
                                    @selected(request('status') === 'archived')
                                >
                                    {{ __('Archived') }}
                                </option>

                                <option
                                    value="draft"
                                    @selected(request('status') === 'draft')
                                >
                                    {{ __('Draft') }}
                                </option>
                            </select>
                        </div>

                        {{-- Date From --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                {{ __('Date From') }}
                            </label>

                            <input
                                type="date"
                                name="date_from"
                                value="{{ request('date_from') }}"
                                class="w-full rounded-lg border-gray-300 focus:border-gray-500 focus:ring-gray-500"
                            >
                        </div>

                        {{-- Date To --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                {{ __('Date To') }}
                            </label>

                            <input
                                type="date"
                                name="date_to"
                                value="{{ request('date_to') }}"
                                class="w-full rounded-lg border-gray-300 focus:border-gray-500 focus:ring-gray-500"
                            >
                        </div>

                        {{-- Buttons --}}
                        <div class="flex items-end gap-2 lg:col-span-3">

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-gray-900 text-white rounded-lg font-medium text-sm hover:bg-gray-700 transition"
                            >
                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M21 21l-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"
                                    />
                                </svg>

                                {{ __('Search') }}
                            </button>

                            @if(request()->hasAny([
                                'q',
                                'category',
                                'project_id',
                                'status',
                                'date_from',
                                'date_to'
                            ]))
                                <a
                                    href="{{ route('admin.documents.index') }}"
                                    class="inline-flex items-center justify-center px-5 py-2.5 bg-white dark:bg-slate-800 border border-gray-300 text-gray-700 rounded-lg font-medium text-sm hover:bg-gray-50 dark:bg-slate-900 transition"
                                >
                                    {{ __('Clear Filters') }}
                                </a>
                            @endif

                        </div>

                    </form>
                </div>

                {{-- Documents Table --}}
                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-50 dark:bg-slate-900">
                            <tr>

                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase tracking-wider">
                                    {{ __('Document') }}
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase tracking-wider">
                                    {{ __('Project') }}
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase tracking-wider">
                                    {{ __('Category') }}
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase tracking-wider">
                                    {{ __('Status') }}
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase tracking-wider">
                                    {{ __('Uploaded By') }}
                                </th>

                                <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase tracking-wider">
                                    {{ __('Actions') }}
                                </th>

                            </tr>
                        </thead>

                        <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200">

                            @forelse($documents as $document)

                                <tr class="hover:bg-gray-50 dark:bg-slate-900 transition">

                                    {{-- Document --}}
                                    <td class="px-6 py-4">

                                        <div class="flex items-center gap-3">

                                            <div class="w-10 h-10 rounded-lg bg-gray-100 dark:bg-slate-700 flex items-center justify-center flex-shrink-0">
                                                <svg
                                                    class="w-5 h-5 text-gray-600"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M7 3h7l5 5v13H7a2 2 0 01-2-2V5a2 2 0 012-2z"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M14 3v6h6"
                                                    />
                                                </svg>
                                            </div>

                                            <div class="min-w-0">

                                                <div class="font-semibold text-gray-900 truncate max-w-xs">
                                                    {{ $document->title }}
                                                </div>

                                                <div class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500 mt-1">
                                                    {{ $document->document_number }}
                                                </div>

                                                <div class="text-xs text-gray-400 dark:text-gray-500 truncate max-w-xs mt-0.5">
                                                    {{ $document->original_name }}
                                                </div>

                                            </div>

                                        </div>

                                    </td>

                                    {{-- Project --}}
                                    <td class="px-6 py-4 text-sm text-gray-700">

                                        @if($document->project)
                                            <div class="font-medium text-gray-900">
                                                {{ $document->project->name }}
                                            </div>

                                            @if($document->project->code)
                                                <div class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500 mt-1">
                                                    {{ $document->project->code }}
                                                </div>
                                            @endif
                                        @else
                                            <span class="text-gray-400 dark:text-gray-500">
                                                {{ __('General') }}
                                            </span>
                                        @endif

                                    </td>

                                    {{-- Category --}}
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        @if($document->category)
                                            <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 dark:bg-slate-700 text-gray-700">
                                                {{ $document->category }}
                                            </span>
                                        @else
                                            <span class="text-gray-400 dark:text-gray-500">
                                                —
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Status --}}
                                    <td class="px-6 py-4">

                                        @php
                                            $statusClasses = match($document->status) {
                                                'active' => 'bg-green-100 text-green-700',
                                                'archived' => 'bg-yellow-100 text-yellow-700',
                                                'draft' => 'bg-gray-100 dark:bg-slate-700 text-gray-700',
                                                default => 'bg-blue-100 text-blue-700',
                                            };
                                        @endphp

                                        <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold {{ $statusClasses }}">
                                            {{ ucfirst($document->status) }}
                                        </span>

                                    </td>

                                    {{-- Uploaded By --}}
                                    <td class="px-6 py-4 text-sm text-gray-700">

                                        @if($document->uploader)
                                            <div class="font-medium text-gray-900">
                                                {{ $document->uploader->name }}
                                            </div>
                                        @else
                                            <span class="text-gray-400 dark:text-gray-500">
                                                —
                                            </span>
                                        @endif

                                    </td>

                                    {{-- Actions --}}
                                    <td class="px-6 py-4 text-right text-sm">

                                        <div class="flex justify-end items-center gap-3 flex-wrap">

                                            @can('view_documents')
                                                <a
                                                    href="{{ route('admin.documents.show', $document) }}"
                                                    class="text-blue-600 hover:text-blue-900 font-medium"
                                                >
                                                    {{ __('View') }}
                                                </a>
                                            @endcan

                                            @can('download_document')
                                                <a
                                                    href="{{ route('admin.documents.download', $document) }}"
                                                    class="text-green-600 hover:text-green-900 font-medium"
                                                >
                                                    {{ __('Download') }}
                                                </a>
                                            @endcan

                                            @can('edit_document')
                                                <a
                                                    href="{{ route('admin.documents.edit', $document) }}"
                                                    class="text-indigo-600 hover:text-indigo-900 font-medium"
                                                >
                                                    {{ __('Edit') }}
                                                </a>
                                            @endcan

                                            @can('delete_document')
                                                <form
                                                    method="POST"
                                                    action="{{ route('admin.documents.destroy', $document) }}"
                                                    onsubmit="return confirm('{{ __('Are you sure you want to delete this document?') }}')"
                                                >
                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="text-red-600 hover:text-red-900 font-medium"
                                                    >
                                                        {{ __('Delete') }}
                                                    </button>
                                                </form>
                                            @endcan

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td
                                        colspan="6"
                                        class="px-6 py-16 text-center"
                                    >

                                        <div class="flex flex-col items-center justify-center">

                                            <div class="w-16 h-16 rounded-full bg-gray-100 dark:bg-slate-700 flex items-center justify-center mb-4">
                                                <svg
                                                    class="w-8 h-8 text-gray-400 dark:text-gray-500"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M7 3h7l5 5v13H7a2 2 0 01-2-2V5a2 2 0 012-2z"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M14 3v6h6"
                                                    />
                                                </svg>
                                            </div>

                                            <h3 class="text-base font-semibold text-gray-900">
                                                {{ __('No documents found.') }}
                                            </h3>

                                            <p class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500 mt-1">
                                                {{ __('There are no documents matching your current filters.') }}
                                            </p>

                                            @can('upload_document')
                                                <a
                                                    href="{{ route('admin.documents.create') }}"
                                                    class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-gray-900 text-white rounded-lg text-sm font-medium hover:bg-gray-700 transition"
                                                >
                                                    {{ __('Upload Document') }}
                                                </a>
                                            @endcan

                                        </div>

                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- Pagination --}}
                @if($documents->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $documents->links() }}
                    </div>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>
