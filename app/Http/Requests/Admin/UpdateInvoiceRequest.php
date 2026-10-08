<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('edit_invoice') ?? false;
    }

    public function rules(): array
    {
        return [
            'project_id' => [
                'nullable',
                'exists:projects,id',
            ],

            'budget_id' => [
                'nullable',
                'exists:budgets,id',
            ],

            'vendor' => [
                'required',
                'string',
                'max:255',
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

            'invoice_date' => [
                'required',
                'date',
            ],

            'due_date' => [
                'nullable',
                'date',
                'after_or_equal:invoice_date',
            ],

            'subtotal' => [
                'required',
                'numeric',
                'min:0',
            ],

            'tax_amount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            // status is intentionally not editable here — use the
            // dedicated submit/approve/reject/cancel actions instead.
        ];
    }
}
