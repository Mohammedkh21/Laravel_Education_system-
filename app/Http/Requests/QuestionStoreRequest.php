<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionStoreRequest extends FormRequest
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
            'title'=>'required|string'	,
            'type'=>'required|string',
            'options'=>'required'	,
            'correct_answer'=>'required',
            'mark'=>'required|integer'
        ];
    }

    function getData()
    {
        return $this->only(['title'	,'type',	'options'	,'correct_answer',	'mark']);
    }
}
