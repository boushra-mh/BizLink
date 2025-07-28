<?php

namespace App\Http\Requests\Web\Admin\ServiceProviders;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => 'required|string|max:255',
            'shop_name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => ['required', Rule::in(['active', 'inactive', 'expired'])], // حسب enum

            'phone' => 'required|string|max:10',
            'whatsapp' => 'nullable|string|max:10',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'location' => 'nullable|string|max:255',

            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'sub_category_ids' => 'required|array|min:1',
            'sub_category_ids.*' => 'exists:sub_categories,id',

            'city_ids' => 'required|array|min:1',
            'city_ids.*' => 'exists:cities,id',

            'tag_ids' => 'required|array|min:1',
            'tag_ids.*' => 'exists:tags,id',
        ];
    }
}
