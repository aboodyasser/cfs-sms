<?php

namespace App\Http\Requests\Admin;

use App\Models\Document;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('edit_document') ?? false;
    }

    public function rules(): array
    {
        $document = $this->route('document');

        $documentId = $document instanceof Document
            ? $document->id
            : $document;

        return [
            'document_number' => [
                'required',
                'string',
                'max:50',
                Rule::unique('documents', 'document_number')
                    ->ignore($documentId),
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'category' => [
                'required',
                'string',
                'max:100',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'project_id' => [
                'nullable',
                'exists:projects,id',
            ],

            'expense_id' => [
                'nullable',
                'exists:expenses,id',
            ],

            'contract_id' => [
                'nullable',
                'exists:contracts,id',
            ],

            'department_id' => [
                'nullable',
                'exists:departments,id',
            ],

            'document_date' => [
                'nullable',
                'date',
            ],

            'file' => [
                'nullable',
                'file',
                'max:10240',
                'mimes:pdf,doc,docx,xls,xlsx,csv,jpg,jpeg,png',
            ],
        ];
    }
}
