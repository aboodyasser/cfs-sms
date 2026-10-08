<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                {{ __('Edit Document') }}
            </h2>

            <a
                href="{{ route('admin.documents.show', $document) }}"
                class="text-sm text-gray-600 hover:text-gray-900"
            >
                {{ __('Back to Document') }}
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg p-6">

                @if($errors->any())
                    <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4">
                        <ul class="list-disc list-inside text-red-600">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form
                    method="POST"
                    action="{{ route('admin.documents.update', $document) }}"
                    enctype="multipart/form-data"
                    class="space-y-6"
                >
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            {{ __('Project') }}
                        </label>

                        <select
                            name="project_id"
                            class="mt-1 block w-full rounded-md border-gray-300"
                        >
                            <option value="">
                                {{ __('General Document') }}
                            </option>

                            @foreach($projects as $project)
                                <option
                                    value="{{ $project->id }}"
                                    @selected(old('project_id', $document->project_id) == $project->id)
                                >
                                    {{ $project->code }} - {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            {{ __('Title') }}
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title', $document->title) }}"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            {{ __('Description') }}
                        </label>

                        <textarea
                            name="description"
                            rows="4"
                            class="mt-1 block w-full rounded-md border-gray-300"
                        >{{ old('description', $document->description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                {{ __('Category') }}
                            </label>

                            <input
                                type="text"
                                name="category"
                                value="{{ old('category', $document->category) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                {{ __('Document Type') }}
                            </label>

                            <input
                                type="text"
                                name="document_type"
                                value="{{ old('document_type', $document->document_type) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                {{ __('Document Number') }}
                            </label>

                            <input
                                type="text"
                                name="document_number"
                                value="{{ old('document_number', $document->document_number) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                {{ __('Document Date') }}
                            </label>

                            <input
                                type="date"
                                name="document_date"
                                value="{{ old('document_date', $document->document_date?->format('Y-m-d')) }}"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>

                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            {{ __('Status') }}
                        </label>

                        <select
                            name="status"
                            class="mt-1 block w-full rounded-md border-gray-300"
                        >
                            <option value="active" @selected(old('status', $document->status) === 'active')>
                                {{ __('Active') }}
                            </option>

                            <option value="archived" @selected(old('status', $document->status) === 'archived')>
                                {{ __('Archived') }}
                            </option>

                            <option value="draft" @selected(old('status', $document->status) === 'draft')>
                                {{ __('Draft') }}
                            </option>
                        </select>
                    </div>

                    <div class="border-t pt-6">
                        <label class="block text-sm font-medium text-gray-700">
                            {{ __('Replace File') }}
                        </label>

                        <p class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500 mb-2">
                            {{ $document->file_name }}
                        </p>

                        <input
                            type="file"
                            name="file"
                            class="block w-full"
                        >
                    </div>

                    <div class="flex justify-end gap-3">

                        <a
                            href="{{ route('admin.documents.show', $document) }}"
                            class="px-4 py-2 border rounded-md text-gray-700"
                        >
                            {{ __('Cancel') }}
                        </a>

                        <button
                            type="submit"
                            class="px-4 py-2 bg-gray-900 text-white rounded-md"
                        >
                            {{ __('Save Changes') }}
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
