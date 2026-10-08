<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                {{ $document->title }}
            </h2>

            <a
                href="{{ route('admin.documents.index') }}"
                class="text-sm text-gray-600 hover:text-gray-900"
            >
                {{ __('Back to Documents') }}
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 rounded-lg bg-green-50 border border-green-200 p-4 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg p-6">

                <div class="flex justify-between items-start mb-8">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">
                            {{ $document->title }}
                        </h1>

                        <p class="text-gray-500 dark:text-gray-400 dark:text-gray-500 mt-1">
                            {{ $document->file_name }}
                        </p>
                    </div>

                    <div class="flex gap-3">

                        @can('download_document')
                            <a
                                href="{{ route('admin.documents.download', $document) }}"
                                class="px-4 py-2 bg-green-600 text-white rounded-md"
                            >
                                {{ __('Download') }}
                            </a>
                        @endcan

                        @can('edit_document')
                            <a
                                href="{{ route('admin.documents.edit', $document) }}"
                                class="px-4 py-2 bg-gray-800 text-white rounded-md"
                            >
                                {{ __('Edit') }}
                            </a>
                        @endcan

                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <span class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                            {{ __('Project') }}
                        </span>

                        <p class="font-medium">
                            {{ $document->project?->name ?? __('General Document') }}
                        </p>
                    </div>

                    <div>
                        <span class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                            {{ __('Category') }}
                        </span>

                        <p class="font-medium">
                            {{ $document->category ?? '—' }}
                        </p>
                    </div>

                    <div>
                        <span class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                            {{ __('Document Number') }}
                        </span>

                        <p class="font-medium">
                            {{ $document->document_number ?? '—' }}
                        </p>
                    </div>

                    <div>
                        <span class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                            {{ __('Document Date') }}
                        </span>

                        <p class="font-medium">
                            {{ $document->document_date?->format('Y-m-d') ?? '—' }}
                        </p>
                    </div>

                    <div>
                        <span class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                            {{ __('Uploaded By') }}
                        </span>

                        <p class="font-medium">
                            {{ $document->uploader?->name ?? '—' }}
                        </p>
                    </div>

                    <div>
                        <span class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                            {{ __('File Size') }}
                        </span>

                        <p class="font-medium">
                            {{ $document->formatted_file_size }}
                        </p>
                    </div>

                    <div>
                        <span class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                            {{ __('Status') }}
                        </span>

                        <p class="font-medium">
                            {{ ucfirst($document->status) }}
                        </p>
                    </div>

                    <div>
                        <span class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                            {{ __('Document Type') }}
                        </span>

                        <p class="font-medium">
                            {{ $document->document_type ?? '—' }}
                        </p>
                    </div>

                </div>

                @if($document->description)
                    <div class="mt-8 border-t pt-6">
                        <h3 class="font-semibold text-gray-900">
                            {{ __('Description') }}
                        </h3>

                        <p class="mt-2 text-gray-700 whitespace-pre-line">
                            {{ $document->description }}
                        </p>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
