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
            // 'receiver_id' => ['required', 'exists:users,id', 'different:sender_id'],
            'receiver_id' => ['required', 'exists:users,id'],
            'gifts' => ['required', 'array', 'min:1'],
            'gifts.*.id' => ['required', 'exists:gifts,id'], 
            'gifts.*.visibility' => ['required', Rule::in(UserGiftVisibility::getAll())],
            'gifts.*.message' => ['nullable', 'string', 'max:25'],
            'gifts.*.price' => ['required', 'numeric', 'min:0'],
            'totalPrice' => ['required', 'numeric', 'min:0'],
        ];
    }

    // Optionally add custom messages
    public function messages(): array
    {
        return [
            'receiver_id.required' => __('gifts.receiver_id_required'),
            'receiver_id.exists' => __('gifts.receiver_id_exists'),
    
            'gifts.required' => __('gifts.gifts_required'),
            'gifts.array' => __('gifts.gifts_array'),
            'gifts.min' => __('gifts.gifts_min'),
    
            'gifts.*.id.required' => __('gifts.gift_id_required'),
            'gifts.*.id.exists' => __('gifts.gift_id_exists'),
    
            'gifts.*.visibility.required' => __('gifts.visibility_required'),
            'gifts.*.visibility.in' => __('gifts.visibility_invalid'),
    
            'gifts.*.msg.string' => __('gifts.message_string'),
            'gifts.*.msg.max' => __('gifts.message_max'),
    
            'gifts.*.price.required' => __('gifts.price_required'),
            'gifts.*.price.numeric' => __('gifts.price_numeric'),
            'gifts.*.price.min' => __('gifts.price_min'),

            'totalPrice.required' => __('gifts.total_price_required'),
            'totalPrice.numeric' => __('gifts.total_price_numeric'),
            'totalPrice.min' => __('gifts.total_price_min'),
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
