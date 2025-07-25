<?php

namespace App\Http\Requests\Api\Customer\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'phone'      => 'required|string|size:10|unique:customers,phone',
            'state_id'   => 'required|exists:states,id',
            'city_id'    => 'required|exists:cities,id',
            'password'   => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[a-z]/',     
                'regex:/[A-Z]/',     
                'regex:/[0-9]/',     
                'regex:/[@$!%*#?&]/',   
            ],
            'accept_terms' => 'accepted',
        ];
    }
       public function messages()
    {
        return [
            'password.regex' => 'Password must include uppercase, lowercase, number, and special character.',
            'accept_terms.accepted' => 'You must accept terms and conditions.',
          
        ];
    }
}
