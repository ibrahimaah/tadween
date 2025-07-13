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
            'gift_ids' => ['required', 'array', 'min:1'],
            'gift_ids.*' => ['required', 'exists:gifts,id'],
            // 'gift_id' => ['required', 'exists:gifts,id'],
            'userGiftVisibility' => ['required', Rule::in(UserGiftVisibility::getAll())],
            'msg' => ['nullable', 'string', 'max:25'],
            'totalPrice' => ['required', 'numeric', 'min:0'],
        ];
    }

    // Optionally add custom messages
    public function messages()
    {
        return [
            'receiver_id.different' => __('gifts.cannot_send_self'),
            'receiver_id.required' => __('validation.required', ['attribute' => __('gifts.receiver')]),
            'receiver_id.exists' => __('validation.exists', ['attribute' => __('gifts.receiver')]),
            'gift_ids.required' => __('gifts.please_select_gift'),
            'gift_ids.array' => __('gifts.invalid_gift_format'),
            'gift_ids.*.exists' => __('validation.exists', ['attribute' => __('gifts.gift')]),
            // 'gift_id.required' => __('validation.required', ['attribute' => __('gifts.gift')]),
            // 'gift_id.exists' => __('validation.exists', ['attribute' => __('gifts.gift')]),
            'userGiftVisibility.required' => __('validation.required', ['attribute' => __('gifts.visibility')]),
            'userGiftVisibility.in' => __('validation.in', ['attribute' => __('gifts.visibility')]),
            'msg.max' => __('validation.max.string', ['attribute' => __('gifts.message'), 'max' => 100]),
            'totalPrice.required' => __('validation.required', ['attribute' => __('gifts.total_price')]),
            'totalPrice.numeric' => __('validation.numeric', ['attribute' => __('gifts.total_price')]),
            'totalPrice.min' => __('validation.min.numeric', ['attribute' => __('gifts.total_price'), 'min' => 0]),

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
