<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create_expense') ?? false;
    }

    public function rules(): array
    {
        return [
            'project_id' => [
                'nullable',
                'exists:projects,id',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'category' => [
                'required',
                'string',
                'max:100',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'expense_date' => [
                'required',
                'date',
            ],

            'vendor' => [
                'nullable',
                'string',
                'max:255',
            ],

            'invoice_number' => [
                'nullable',
                'string',
                'max:100',
            ],

            'status' => [
                'required',
                Rule::in([
                    'draft',
                    'submitted',
                ]),
            ],
        
            'documents' => ['nullable', 'array'],
            'documents.*' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp,doc,docx', 'max:10240'],
            'file_descriptions' => ['nullable', 'array'],
            'file_descriptions.*' => ['nullable', 'string', 'max:255'],
        ];
    }
}
