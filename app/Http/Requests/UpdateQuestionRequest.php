<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'subject_id' => 'sometimes|exists:subjects,id',
            'topic_id' => 'sometimes|exists:topics,id',
            'name' => 'sometimes|string|max:255',
            'order' => 'sometimes|numeric|min:1|max:100',
            'status' => 'sometimes|boolean',
            'difficulty_level' => 'sometimes|in:easy,medium,hard',
            'created_by' => 'sometimes|exists:users,id',
        ];
    }
}
