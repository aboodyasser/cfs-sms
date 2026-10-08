<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateContractRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('edit_contract') ?? false;
    }

    public function rules(): array
    {
        return [
            'project_id' => [
                'required',
                'exists:projects,id',
            ],

            'party_type' => [
                'required',
                'string', 'max:255',
            ],

            'party_name' => [
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

            'contract_value' => [
                'nullable',
                'numeric',
                'min:0',
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

            // status is intentionally not editable here — use the
            // dedicated submit/approve/reject/activate/complete/
            // terminate/cancel actions instead.
        ];
    }
}
