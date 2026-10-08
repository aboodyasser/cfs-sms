<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('edit_payment') ?? false;
    }

    public function rules(): array
    {
        return [
            'payment_method' => [
                'required',
                'string',
                'max:50',
            ],

            'payment_date' => [
                'required',
                'date',
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
        ];
    }
}
