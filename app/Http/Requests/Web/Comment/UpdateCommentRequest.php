<?php

namespace App\Http\Requests\Web\Comment;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommentRequest extends FormRequest
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
                "comment" => "required|string",
                // "written_by" => "required|exists:users,id", // are static not updated
                // "task_id" => "required|exists:tasks,id"  // are static not updated
            ];
        } elseif ($method === "PATCH") {
            return [
                "comment" => "sometimes|required|string",
                // "written_by" => "sometimes|required|exists:users,id", // are static not updated
                // "task_id" => "sometimes|required|exists:tasks,id" // are static not updated
            ];
        }
    }
}
