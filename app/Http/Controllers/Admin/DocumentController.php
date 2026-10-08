<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDocumentRequest;
use App\Http\Requests\Admin\UpdateDocumentRequest;
use App\Models\Contract;
use App\Models\Department;
use App\Models\Document;
use App\Models\Expense;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    /**
     * Display a listing of documents.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Document::class);

        $documents = Document::query()
            ->with([
                'project',
                'expense',
                'contract',
                'department',
                'uploader',
            ])
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->string('q')->toString();

                $query->where(function ($q) use ($search) {
                    $q->where('document_number', 'like', "%{$search}%")
                        ->orWhere('title', 'like', "%{$search}%")
                        ->orWhere('original_name', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->where(
                    'category',
                    $request->string('category')->toString()
                );
            })
            ->when($request->filled('project_id'), function ($query) use ($request) {
                $query->where(
                    'project_id',
                    $request->integer('project_id')
                );
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where(
                    'status',
                    $request->string('status')->toString()
                );
            })
            ->when($request->filled('date_from'), function ($query) use ($request) {
                $query->whereDate(
                    'document_date',
                    '>=',
                    $request->date_from
                );
            })
            ->when($request->filled('date_to'), function ($query) use ($request) {
                $query->whereDate(
                    'document_date',
                    '<=',
                    $request->date_to
                );
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $projects = Project::query()
            ->orderBy('name')
            ->get(['id', 'name', 'code']);

        $categories = Document::query()
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('admin.documents.index', compact(
            'documents',
            'projects',
            'categories'
        ));
    }

    /**
     * Show the form for creating a document.
     */
    public function create()
    {
        $this->authorize('create', Document::class);

        $projects = Project::query()
            ->orderBy('name')
            ->get(['id', 'name', 'code']);

        $expenses = Expense::query()
            ->orderByDesc('expense_date')
            ->get([
                'id',
                'expense_number',
                'title',
                'project_id',
                'amount',
            ]);

        $contracts = Contract::query()
            ->orderByDesc('start_date')
            ->get([
                'id',
                'contract_number',
                'title',
                'project_id',
            ]);

        $departments = Department::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('admin.documents.create', compact(
            'projects',
            'expenses',
            'contracts',
            'departments'
        ));
    }

    /**
     * Store a newly uploaded document.
     */
    public function store(StoreDocumentRequest $request)
    {
        $validated = $request->validated();

        $file = $request->file('file');

        $storedName = Str::uuid()->toString()
            . '.' . $file->getClientOriginalExtension();

        $path = $file->storeAs(
            'documents',
            $storedName,
            'local'
        );

        Document::create([
            'document_number' => $validated['document_number'],
            'title' => $validated['title'],
            'category' => $validated['category'],
            'description' => $validated['description'] ?? null,
            'project_id' => $validated['project_id'] ?? null,
            'expense_id' => $validated['expense_id'] ?? null,
            'contract_id' => $validated['contract_id'] ?? null,
            'department_id' => $validated['department_id'] ?? null,
            'uploaded_by' => $request->user()->id,
            'document_date' => $validated['document_date'] ?? null,
            'original_name' => $file->getClientOriginalName(),
            'stored_name' => $storedName,
            'disk' => 'local',
            'path' => $path,
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
            'status' => 'active',
        ]);

        return redirect()
            ->route('admin.documents.index')
            ->with('success', 'Document uploaded successfully.');
    }

    /**
     * Display the specified document.
     */
    public function show(Document $document)
    {
        $this->authorize('view', $document);

        $document->load([
            'project',
            'expense',
            'contract',
            'department',
            'uploader',
        ]);

        return view('admin.documents.show', compact('document'));
    }

    /**
     * Show the form for editing the document.
     */
    public function edit(Document $document)
    {
        $this->authorize('update', $document);

        $projects = Project::query()
            ->orderBy('name')
            ->get(['id', 'name', 'code']);

        $expenses = Expense::query()
            ->orderByDesc('expense_date')
            ->get([
                'id',
                'expense_number',
                'title',
                'project_id',
                'amount',
            ]);

        $contracts = Contract::query()
            ->orderByDesc('start_date')
            ->get([
                'id',
                'contract_number',
                'title',
                'project_id',
            ]);

        $departments = Department::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('admin.documents.edit', compact(
            'document',
            'projects',
            'expenses',
            'contracts',
            'departments'
        ));
    }

    /**
     * Update document metadata and optionally replace its file.
     */
    public function update(
        UpdateDocumentRequest $request,
        Document $document
    ) {
        $validated = $request->validated();

        $data = [
            'document_number' => $validated['document_number'],
            'title' => $validated['title'],
            'category' => $validated['category'],
            'description' => $validated['description'] ?? null,
            'project_id' => $validated['project_id'] ?? null,
            'expense_id' => $validated['expense_id'] ?? null,
            'contract_id' => $validated['contract_id'] ?? null,
            'department_id' => $validated['department_id'] ?? null,
            'document_date' => $validated['document_date'] ?? null,
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            if ($document->path) {
                Storage::disk($document->disk)->delete($document->path);
            }

            $storedName = Str::uuid()->toString()
                . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs(
                'documents',
                $storedName,
                'local'
            );

            $data['original_name'] = $file->getClientOriginalName();
            $data['stored_name'] = $storedName;
            $data['disk'] = 'local';
            $data['path'] = $path;
            $data['mime_type'] = $file->getMimeType();
            $data['file_size'] = $file->getSize();
        }

        $document->update($data);

        return redirect()
            ->route('admin.documents.show', $document)
            ->with('success', 'Document updated successfully.');
    }

    /**
     * Download the document.
     */
    public function download(Document $document)
    {
        $this->authorize('download', $document);

        abort_unless(
            Storage::disk($document->disk)->exists($document->path),
            404
        );

        return Storage::disk($document->disk)->download(
            $document->path,
            $document->original_name
        );
    }

    /**
     * Remove the specified document.
     */
    public function destroy(Document $document)
    {
        $this->authorize('delete', $document);

        if ($document->path) {
            Storage::disk($document->disk)->delete($document->path);
        }

        $document->delete();

        return redirect()
            ->route('admin.documents.index')
            ->with('success', 'Document deleted successfully.');
    }
}
