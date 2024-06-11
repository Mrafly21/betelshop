<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BecomeSellerFormRequest extends FormRequest
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
    public function rules()
    {
        return [
            'user_name' => [
                'required',
                'string'
            ],
            'email' => [
                'required',
                'string'
            ],
            'contact_number' => [
                'required',
            ],
            'description' => [
                'required',
                'string'
            ]
        ];
    }
}
