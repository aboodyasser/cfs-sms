@props(['model'])

@php
    $canUpload = auth()->user()->can('upload_attachments');
    $canView = auth()->user()->can('view_attachments');
    $canDelete = auth()->user()->can('delete_attachments');
@endphp

<div class="bg-white dark:bg-slate-800 rounded-2xl border border-gray-100 shadow-xl shadow-gray-100/50 p-6 mt-6">
    <div class="flex items-center justify-between pb-4 border-b border-gray-100 mb-6">
        <div>
            <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                <i class="fas fa-paperclip text-indigo-600"></i>
                {{ __('Attachments & Files') }}
            </h3>
            <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">
                {{ __('Manage related documents, scanned checks, and receipts.') }}
            </p>
        </div>
        <span class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-xs font-semibold">
            {{ $model->attachments->count() }} {{ __('Files') }}
        </span>
    </div>

    {{-- نموذج رفع ملف جديد (يظهر لمن يملك الصلاحية) --}}
    @if($canUpload)
        <form action="{{ route('admin.attachments.store') }}" method="POST" enctype="multipart/form-data" class="mb-8 p-4 bg-gray-50 dark:bg-slate-900/70 rounded-xl border border-gray-200 dark:border-slate-700/60">
            @csrf
            <input type="hidden" name="model_type" value="{{ get_class($model) }}">
            <input type="hidden" name="model_id" value="{{ $model->id }}">

            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
                <div class="md:col-span-5">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">{{ __('Document Title') }}</label>
                    <input
                        type="text"
                        name="title"
                        required
                        placeholder="{{ __('e.g., First Payment Check') }}"
                        class="w-full rounded-xl border-gray-200 dark:border-slate-700 text-sm focus:border-indigo-500 focus:ring-indigo-500 bg-white dark:bg-slate-800"
                    >
                </div>
                <div class="md:col-span-5">
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">{{ __('Select File (PDF, Images, Doc)') }}</label>
                    <input
                        type="file"
                        name="file"
                        required
                        class="w-full text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition cursor-pointer bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 rounded-xl"
                    >
                </div>
                <div class="md:col-span-2">
                    <button
                        type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl text-xs shadow-sm transition"
                    >
                        <i class="fas fa-upload"></i>
                        <span>{{ __('Upload') }}</span>
                    </button>
                </div>
            </div>
        </form>
    @endif

    {{-- قائمة المرفقات الحالية --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($model->attachments as $attachment)
            <div class="group relative flex flex-col justify-between p-4 bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700/80 rounded-xl hover:border-indigo-300 hover:shadow-md transition-all duration-200">
                <div>
                    <div class="flex items-start justify-between gap-3 mb-2">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center flex-shrink-0 text-sm">
                            @if(str_contains($attachment->file_type, 'image'))
                                <i class="fas fa-file-image"></i>
                            @elseif(str_contains($attachment->file_type, 'pdf'))
                                <i class="fas fa-file-pdf text-rose-500"></i>
                            @else
                                <i class="fas fa-file-lines"></i>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-semibold text-gray-900 text-sm truncate" title="{{ $attachment->title }}">
                                {{ $attachment->title }}
                            </h4>
                            <p class="text-[11px] text-gray-400 dark:text-gray-500 truncate mt-0.5">
                                {{ $attachment->file_name }}
                            </p>
                        </div>
                    </div>

                    <div class="text-[11px] text-gray-500 dark:text-gray-400 dark:text-gray-500 space-y-1 my-3 bg-gray-50 dark:bg-slate-900 p-2.5 rounded-lg">
                        <div class="flex justify-between">
                            <span>{{ __('Size:') }}</span>
                            <span class="font-medium text-gray-700">{{ number_format($attachment->file_size / 1024, 1) }} KB</span>
                        </div>
                        <div class="flex justify-between">
                            <span>{{ __('Uploaded By:') }}</span>
                            <span class="font-medium text-gray-700">{{ $attachment->uploader->name ?? __('Unknown') }}</span>
                        </div>
                    </div>
                </div>

                {{-- أزرار الإجراءات (تحميل وعرض وحذف) --}}
                <div class="flex items-center justify-between pt-3 border-t border-gray-100 mt-2">
                    @if($canView)
                        <a
                            href="{{ route('admin.attachments.download', $attachment) }}"
                            target="_blank"
                            class="inline-flex items-center gap-1.5 text-xs font-semibold text-indigo-600 hover:text-indigo-800 transition"
                        >
                            <i class="fas fa-download text-[10px]"></i>
                            <span>{{ __('Download') }}</span>
                        </a>
                    @else
                        <span></span>
                    @endif

                    @if($canDelete)
                        <form
                            action="{{ route('admin.attachments.destroy', $attachment) }}"
                            method="POST"
                            onsubmit="return confirm('{{ __('Are you sure you want to delete this file?') }}')"
                        >
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="text-xs text-rose-500 hover:text-rose-700 p-1.5 rounded-lg hover:bg-rose-50 transition"
                                title="{{ __('Delete') }}"
                            >
                                <i class="fas fa-trash-can"></i>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center">
                <div class="w-12 h-12 mx-auto rounded-full bg-gray-50 dark:bg-slate-900 flex items-center justify-center text-gray-400 dark:text-gray-500 mb-3 text-lg">
                    <i class="fas fa-folder-open"></i>
                </div>
                <p class="text-sm font-medium text-gray-600">{{ __('No attachments found.') }}</p>
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">{{ __('Upload files using the form above.') }}</p>
            </div>
        @endforelse
    </div>
</div>
