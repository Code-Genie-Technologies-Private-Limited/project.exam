<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBatchRequest extends FormRequest
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
            'course_id' => 'required|exists:courses,id',
            'sub_course_id' => 'required|exists:sub_courses,id',
            'name' => 'required|min:3|max:160',
            'code' => 'required|min:3|max:160',
            'order' => 'decimal:2',
            'status' => 'boolean',
        ];
    }
}