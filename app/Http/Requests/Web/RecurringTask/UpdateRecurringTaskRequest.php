<?php

namespace App\Http\Requests\Web\RecurringTask;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecurringTaskRequest extends FormRequest
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
                'frequency' => 'required|in:daily,weekly,monthly',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
                'created_by' => 'required|exists:users,id',
            ];
        } elseif ($method === "PATCH") {
            return [
                'title' => 'sometimes|required|string|max:255',
                'short_description' => 'sometimes|nullable|string',
                'long_description' => 'sometimes|nullable|string',
                'frequency' => 'sometimes|required|in:daily,weekly,monthly',
                'start_date' => 'sometimes|required|date',
                'end_date' => 'sometimes|nullable|date|after_or_equal:start_date',
                'created_by' => 'sometimes|required|exists:users,id',
            ];
        }
    }
}
