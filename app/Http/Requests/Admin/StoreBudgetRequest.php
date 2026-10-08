<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBudgetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create_budget') ?? false;
    }

    public function rules(): array
    {
        return [
            'project_id' => [
                'required',
                'exists:projects,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'category' => [
                'required',
                'string',
                'max:100',
            ],

            'allocated_amount' => [
                'required',
                'numeric',
                'min:0',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'status' => [
                'required',
                Rule::in([
                    'draft',
                    'active',
                    'closed',
                ]),
            ],
        
            'documents' => ['nullable', 'array'],
            'documents.*' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp,doc,docx', 'max:10240'],
            'file_descriptions' => ['nullable', 'array'],
            'file_descriptions.*' => ['nullable', 'string', 'max:255'],
        ];
    }
}
