<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DepositToWalletRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|min:0.01',
            'captureId' => 'nullable|string',
            'paymentMethod' => 'nullable|string',
            'status' => 'required|string|in:COMPLETED,VOIDED,PAYER_ACTION_REQUIRED,APPROVED'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all(); // Get all error messages as an array

        // You can either return all messages as a string or join them:
        $errorMessage = implode(' | ', $errors);

        throw new HttpResponseException(response()->json([
            'code' => 0,
            'msg' => $errorMessage,
        ], 422));
    }
}
