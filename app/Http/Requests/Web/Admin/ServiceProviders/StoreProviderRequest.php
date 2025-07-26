<?php

namespace App\Http\Requests\Web\Admin\ServiceProviders;

use Illuminate\Foundation\Http\FormRequest;

class StoreProviderRequest extends FormRequest
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
            'name'           => ['required', 'string', 'max:255'],
            'description'    => ['nullable', 'string'],
            'phone'          => ['required', 'string', 'max:20'],
            'whatsapp'       => ['nullable', 'string', 'max:20'],
            'facebook'       => ['nullable', 'url'],
            'instagram'      => ['nullable', 'url'],
            'location'       => ['required', 'string'],
            'sub_category_id'=> ['required', 'exists:sub_categories,id'],
        ];
    }
     public function messages(): array
    {
        return [
            'name.required' => __('messages.name_required'),
            'phone.required' => __('messages.phone_required'),
            'location.required' => __('messages.location_required'),
            'sub_category_id.required' => __('messages.sub_category_required'),
            'sub_category_id.exists' => __('messages.sub_category_not_found'),
        ];
    }
}
