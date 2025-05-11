<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReplyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'reply_text' => 'nullable|string|max:400',
            'slug_id' => 'required|string|exists:posts,slug_id',
            'reply_image' => 'nullable|image|mimes:jpeg,png,gif,webp,jpg|max:1024',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->filled('reply_text') && !$this->hasFile('reply_image')) {
                $validator->errors()->add('reply_text', 'Either reply text or reply image is required.');
                $validator->errors()->add('reply_image', 'Either reply text or reply image is required.');
            }
        });
    }
      /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'code' => false,
            'msg' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422));
    }
    
}
