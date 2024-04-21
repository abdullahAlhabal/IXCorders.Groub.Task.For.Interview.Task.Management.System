<?php

namespace App\Http\Requests\Web\Attachment;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttachmentRequest extends FormRequest
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
                'attachment_path' => 'required|string',
                'attached_by' => 'required|exists:users,id',
                'task_id' => 'required|exists:tasks,id'
            ];
        } elseif ($method === "PATCH") {
            return [
                'attachment_path' => 'sometimes|required|string',
                'attached_by' => 'sometimes|required|exists:users,id',
                'task_id' => 'sometimes|required|exists:tasks,id'
            ];
        }
    }
}
