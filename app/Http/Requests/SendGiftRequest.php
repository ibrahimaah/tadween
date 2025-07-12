<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Constants\UserGiftVisibility;
use Illuminate\Validation\Rule;

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
            'userGiftVisibility' => ['required', Rule::in(UserGiftVisibility::getAll())],
            'msg' => ['nullable', 'string', 'max:25'],
        ];
    }

    // Optionally add custom messages
    public function messages()
    {
        return [
            'receiver_id.different' => __('gifts.cannot_send_self'),
            'receiver_id.required' => __('validation.required', ['attribute' => __('gifts.receiver')]),
            'receiver_id.exists' => __('validation.exists', ['attribute' => __('gifts.receiver')]),
            'gift_id.required' => __('validation.required', ['attribute' => __('gifts.gift')]),
            'gift_id.exists' => __('validation.exists', ['attribute' => __('gifts.gift')]),
            'userGiftVisibility.required' => __('validation.required', ['attribute' => __('gifts.visibility')]),
            'userGiftVisibility.in' => __('validation.in', ['attribute' => __('gifts.visibility')]),
            'msg.max' => __('validation.max.string', ['attribute' => __('gifts.message'), 'max' => 100]),
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
