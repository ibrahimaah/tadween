<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SendGiftRequest extends FormRequest
{
    public function authorize()
    {
        // Only allow authenticated users to send gifts
        return Auth::check();
    }

    public function rules()
    {
        return [
            'receiver_id' => ['required', 'exists:users,id', 'different:sender_id'],
            'gift_id' => ['required', 'exists:gifts,id'],
            'visibility' => ['required', 'in:public,private,anonymous'],
        ];
    }

    // Optionally add custom messages
    public function messages()
    {
        return [
            'receiver_id.different' => __('gifts.cannot_send_self'),
        ];
    }
    

    // Prepare data for validation by adding sender_id to compare with receiver_id
    protected function prepareForValidation()
    {
        $this->merge([
            'sender_id' => Auth::id(),
        ]);
    }
}
