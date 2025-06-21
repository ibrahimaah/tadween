<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransferWallerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Adjust if using policies
    }

    public function rules(): array
    {
        return [
            'sender_id' => ['required', 'exists:users,id'],
            'receiver_id' => ['required', 'exists:users,id', 'different:sender_id'],
            'amount' => ['required', 'numeric', 'min:0.01'],
        ];
    }

    public function messages(): array
    {
        return [
            'receiver_id.different' => __('wallet.sender_and_receiver_must_be_different'),
        ];
    }
}
