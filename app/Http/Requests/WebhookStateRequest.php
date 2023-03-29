<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;

class WebhookStateRequest extends FormRequest
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
            'merchant_id' => 'required|numeric|exists:users,id',
            'webhook_state' => 'required|in:e,d'
        ];
    }

    /**
     * Function to throw uniform validation error
     *
     * @param Validator $validator
     * @throws HttpResponseException
     * @return void
     */
    public function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'validation_error',
            'data'      => $validator->errors(),
            'code'      => 400
        ]));
    }

    /**
     * Function to customize messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'merchant_id.required' => 'Merchant ID field is required.',
            'merchant_id.numeric' => 'Merchant ID must be a numeric value.',
            'merchant_id.exists' => 'Merchant ID does not exists.',
            'webhook_state.required' => 'Webhook state is required.',
            'webhook_state.in' => 'Webhook state can be either [e = enabled or d = disabled].',
        ];
    }
}
