<?php

namespace App\Http\Requests\Web\Task;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
        $method = $this->method();

        if ($method === "PUT") {
            return [
                'title' => 'required|string|max:255',
                'short_description' => 'nullable|string',
                'long_description' => 'nullable|string',
                'due_date' => 'required|date',
                'priority' => 'required|in:low,medium,high',
                'status_id' => 'nullable|exists:task_statuses,id',
                'status' => 'required|in:To Do,In Progress,Done',
                'created_by' => 'required|exists:users,id',
                'assigned_to' => 'nullable|exists:users,id',
                'is_recurring' => 'boolean',
                'recurring_task_id' => 'nullable|exists:recurring_tasks,id',
            ];
        } elseif ($method === "PATCH") {
            return [
                'title' => 'sometimes|required|string|max:255',
                'short_description' => 'sometimes|nullable|string',
                'long_description' => 'sometimes|nullable|string',
                'due_date' => 'sometimes|required|date',
                'priority' => 'sometimes|required|in:low,medium,high',
                'status_id' => 'sometimes|nullable|exists:task_statuses,id',
                'status' => 'sometimes|required|in:To Do,In Progress,Done',
                'created_by' => 'sometimes|required|exists:users,id',
                'assigned_to' => 'sometimes|nullable|exists:users,id',
                'is_recurring' => 'sometimes|boolean',
                'recurring_task_id' => 'sometimes|nullable|exists:recurring_tasks,id',
            ];
        }
    }
}
