<?php

namespace App\Http\Requests\Admin;

use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('edit_project') ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $project = $this->route('project');

        $projectId = $project instanceof Project
            ? $project->id
            : $project;

        return [
            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('projects', 'code')
                    ->ignore($projectId),
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
        ];
    }
}
