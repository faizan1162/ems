<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventTicketRequest extends FormRequest
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
            'event_id' => 'required|numeric|gt:0',
            'user_id' => 'required|numeric|gt:0',
            'total_price' => 'required',
            'event_ticket_type_id' => 'required|numeric|gt:0',
            'event_ticket_type' => 'required',
            'event_ticket_price' => 'required',
            'event_ticket_qty' => 'required|numeric'
        ];
    }
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response =  commonErrorMessage($validator->errors()->first());
        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
