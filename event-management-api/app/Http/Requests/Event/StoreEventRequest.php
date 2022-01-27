<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'event_title' => 'required|min:3|max:255',
            'event_description' => 'required|min:3|max:255',
            'event_start_date' => 'required',
            'event_start_time' => 'required',
            'event_end_date' => 'required',
            'event_end_time' => 'required',
            'event_location' => 'required',
        ];
    }
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response =  commonErrorMessage($validator->errors()->first());
        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
