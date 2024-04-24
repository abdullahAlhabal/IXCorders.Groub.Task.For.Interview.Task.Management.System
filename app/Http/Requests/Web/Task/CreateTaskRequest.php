<?php

namespace App\Http\Requests\Web\Task;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'due_date' => 'required|date',
            'priority' => 'required|in:low,medium,high',
            'assigned_to'   => 'nullable|exists:users,id',
            'status' => 'required|in:To Do,In Progress,Done',
            'is_recurring' => 'nullable|boolean',
            'recurring_pattern' => 'nullable|in:daily,weekly,monthly',
            'recurring_interval' => 'nullable|integer'
        ];
    }
}
