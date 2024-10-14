<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizUpdateRequest extends FormRequest
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
            'title' => 'sometimes|required|string',
            'description'=> 'sometimes|required|string',
            'degree' => 'sometimes|required|integer',
            'visibility'=> 'sometimes|required|boolean',
            'start_in' => 'sometimes|required|date|after:now',
            'end_in' => [
                'sometimes','required','date',
                function ($attribute, $value, $fail) {
                    $startIn = request()->input('start_in');

                    if ($startIn) {
                        if (strtotime($value) <= strtotime($startIn)) {
                            $fail('The end time must be after the start time.');
                        }
                    } else {
                        if (strtotime($value) <= strtotime(request()->route('quiz')->start_in)) {
                            $fail('The end time must be after the start time.');
                        }
                    }
                }
            ]
        ];
    }
    function getData()
    {
        return $this->only(['title','description','degree','visibility','start_in','end_in']);
    }
}
