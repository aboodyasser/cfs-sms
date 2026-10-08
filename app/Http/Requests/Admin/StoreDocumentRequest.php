<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('upload_document') ?? false;
    }

    public function rules(): array
    {
        return [
            'document_number' => [
                'required',
                'string',
                'max:50',
                'unique:documents,document_number',
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
                'required',
                'file',
                'max:10240',
                'mimes:pdf,doc,docx,xls,xlsx,csv,jpg,jpeg,png',
            ],
        ];
    }
}
