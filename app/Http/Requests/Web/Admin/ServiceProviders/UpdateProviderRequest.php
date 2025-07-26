<?php

namespace App\Http\Requests\Web\Admin\ServiceProviders;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProviderRequest extends FormRequest
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
        $providerId = $this->route('provider'); // أو 'id' حسب اسم الباراميتر

        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'phone' => ['required', 'string', 'max:20', "unique:providers,phone,{$providerId}"],
            'whatsapp' => ['nullable', 'string', 'max:20'],
            'facebook' => ['nullable', 'string', 'url'],
            'instagram' => ['nullable', 'string', 'url'],
            'location' => ['nullable', 'string'],
            'sub_category_id' => ['required', 'exists:sub_categories,id'],
        ];
    }
        public function messages(): array
    {
        return [
            'name.required' => __('messages.validation.name_required'),
            'phone.required' => __('messages.validation.phone_required'),
            'phone.unique' => __('messages.validation.phone_unique'),
            'sub_category_id.required' => __('messages.validation.sub_category_required'),
            'sub_category_id.exists' => __('messages.validation.sub_category_invalid'),
        ];
    }
}
