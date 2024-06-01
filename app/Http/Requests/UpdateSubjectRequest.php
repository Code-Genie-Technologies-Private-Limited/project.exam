<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubjectRequest extends FormRequest
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
            'name' => 'required|min:3|max:255',
            'status' => 'required|boolean|in:active,inactive',
            'order' => 'nullable|integer|min:1'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The selected status is invalid.',
            'order.integer' => 'The order must be an integer.',
            'order.min' => 'The order must be at least 1.',
        ];
    }

}
