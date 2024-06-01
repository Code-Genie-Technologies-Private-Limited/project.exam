<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:160',
            'course_id' => 'required|integer|exists:subjects,id',
            'status' => 'required|boolean',
            'order' => 'required|numeric'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'course_id.required' => 'The course ID field is required.',
            'course_id.exists' => 'The selected course ID is invalid.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The selected status is invalid.',
            'order.integer' => 'The order must be an integer.',
            'order.min' => 'The order must be at least 1.',
        ];
    }
}
