<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'email' => 'required|unique:users|max:100',
            'password' => 'required|min:8|max:100',
            'phone_code' => 'required',
            'phone' => 'required|unique:users|max:10'
        ];
    }
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        $response =  commonErrorMessage($validator->errors()->first());
        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
