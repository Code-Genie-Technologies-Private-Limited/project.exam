<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorequestionRequest extends FormRequest
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
            'name' => 'required|min:1|max:160',
            'subject_id' => 'nullable',
            'topic_id' => 'nullable',
            'difficulty_level' => 'nullable',
        ];
    }
}
