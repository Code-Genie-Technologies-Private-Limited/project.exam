<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTopicRequest extends FormRequest
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
            'subject_id' => 'required|integer|exists:subjects,id',
            'status' => 'required|boolean',
            'order' => 'required|numeric'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'subject_id.required' => 'The subject ID field is required.',
            'subject_id.exists' => 'The selected subject ID is invalid.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The selected status is invalid.',
            'order.integer' => 'The order must be an integer.',
            'order.min' => 'The order must be at least 1.',
        ];
    }
}
