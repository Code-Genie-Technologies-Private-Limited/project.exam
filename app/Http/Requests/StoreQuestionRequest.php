<?php

namespace App\Http\Requests;

use App\Enums\DifficultLevel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreQuestionRequest extends FormRequest
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
            'subject_id' => 'required',
            'topic_id' => 'required',
            'difficulty_level' => ['required', new Enum(DifficultLevel::class)],
        ];
    }
}
