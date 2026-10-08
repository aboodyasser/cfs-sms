<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('create_project') ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'code' => [
                'required',
                'string',
                'max:50',
                'unique:projects,code',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'manager_id' => [
                'nullable',
                'exists:users,id',
            ],

            'department_id' => [
                'nullable',
                'exists:departments,id',
            ],

            'donor' => [
                'nullable',
                'string',
                'max:255',
            ],

            'location' => [
                'nullable',
                'string',
                'max:255',
            ],

            'start_date' => [
                'required',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],

            'status' => [
                'required',
                Rule::in([
                    'draft',
                    'planned',
                    'active',
                    'on_hold',
                    'completed',
                    'cancelled',
                ]),
            ],

            'completion_percentage' => [
                'required',
                'integer',
                'min:0',
                'max:100',
            ],

            'total_budget' => [
                'required',
                'numeric',
                'min:0',
            ],
        
            'documents' => ['nullable', 'array'],
            'documents.*' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp,doc,docx', 'max:10240'],
            'file_descriptions' => ['nullable', 'array'],
            'file_descriptions.*' => ['nullable', 'string', 'max:255'],
        ];
    }
}
