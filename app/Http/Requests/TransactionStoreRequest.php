<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;

class TransactionStoreRequest extends FormRequest
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
            'token' => 'required',
            'transaction_type' => 'required|in:d,c',
            'transaction_status' => 'required|numeric|in:0,1',
            'merchant_code' => 'required|numeric|exists:users,id',
            'amount' => 'required|numeric',
            'transaction_currency' => 'required|max:3',
            'transaction_amount' => 'required|numeric',
            'auth_code' => 'required',
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
            'token.required' => 'Token is required.',
            'transaction_type.required' => 'Transaction type is required.',
            'transaction_type.in' => 'Transaction type can be either [d = debit or c = credit].',
            'transaction_status.required' => 'Transaction status is required.',
            'transaction_status.in' => 'Transaction status can be either [1 = authorized or 0 = declined].',
            'merchant_code.required' => 'Merchant code field is required.',
            'merchant_code.numeric' => 'Merchant code must be a numeric value.',
            'merchant_code.exists' => 'Merchant code does not exists.',
            'amount.required' => 'Amount in merchant\'t currency is required.',
            'amount.numeric' => 'Amount in merchant\'t currency must be numeric value.',
            'transaction_currency.required' => 'Transaction currency iSO code is required.',
            'transaction_currency.max' => 'Transaction currency iSO code must be 3 chars in length.',
            'transaction_amount.required' => 'Transaction amount is required.',
            'transaction_amount.numeric' => 'Transaction amount must be numeric value.',
            'auth_code.required' => 'Auth code is required.',
        ];
    }
}
