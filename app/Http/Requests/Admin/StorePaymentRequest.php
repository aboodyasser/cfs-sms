<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create_payment') ?? false;
    }

    public function rules(): array
    {
        return [
            'invoice_id' => [
                'nullable',
                'exists:invoices,id',
                'required_if:payment_type,expense',
            ],

            'income_id' => [
                'nullable',
                'exists:incomes,id',
                'required_if:payment_type,income',
            ],

            'project_id' => [
                'nullable',
                'exists:projects,id',
            ],

            'payment_type' => [
                'required',
                Rule::in([
                    'expense',
                    'income',
                ]),
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'payment_date' => [
                'required',
                'date',
            ],

            'payment_method' => [
                'required',
                'string',
                'max:50',
            ],

            'reference_number' => [
                'nullable',
                'string',
                'max:100',
            ],

            'description' => [
                'nullable',
                'string',
            ],
        
            'documents' => ['nullable', 'array'],
            'documents.*' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,webp,doc,docx', 'max:10240'],
            'file_descriptions' => ['nullable', 'array'],
            'file_descriptions.*' => ['nullable', 'string', 'max:255'],
        ];
    }
}
