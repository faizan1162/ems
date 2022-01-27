<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'full_name' => 'required|max:100',
            'bio' => 'required|max:255',

        ];
    }
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        $response =  commonErrorMessage($validator->errors()->first());
        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
