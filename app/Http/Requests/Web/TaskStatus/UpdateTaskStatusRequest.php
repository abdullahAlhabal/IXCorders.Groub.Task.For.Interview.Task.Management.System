<?php

namespace App\Http\Requests\Web\TaskStatus;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskStatusRequest extends FormRequest
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
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'color' => 'nullable|string',
                'icon' => 'nullable|string'
            ];
        } elseif ($method === "PATCH") {
            return [
                'name' => 'sometimes|required|string|max:255',
                'description' => 'sometimes|nullable|string',
                'color' => 'sometimes|nullable|string',
                'icon' => 'sometimes|nullable|string'
            ];
        }
    }
}
