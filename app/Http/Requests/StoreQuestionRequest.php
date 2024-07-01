<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
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
            'subject_id' => 'required|exists:subjects,id',
            'topic_id' => 'required|exists:topics,id',
            'name' => 'required|string|max:255',
            'order' => 'required|numeric|min:1|max:100',
            'status' => 'required|boolean',
            'difficulty_level' => 'required|in:easy,medium,hard',
            'created_by' => 'required|exists:users,id',
        ];
    }
}
