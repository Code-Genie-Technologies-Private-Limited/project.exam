<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConceptReadRequest extends FormRequest
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
            // 'course_id' => 'required|exists:courses,id',
            // 'subject_id' => 'required|exists:subjects,id',
            'content_type_name' => 'required|min:3|max:160',
            'description' => 'nullable',
            'order' => 'decimal:2',
            'status' => 'boolean',
        ];
    }
}
