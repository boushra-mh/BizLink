<?php

namespace App\Http\Requests\Web\Admin\CategoriesAndSubCategories;

use App\Enums\StatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class SubCategoryRequest extends FormRequest
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
       return  [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => [$this->isMethod('post') ? 'required' : 'nullable', 'image', 'max:2048'],
              'status' => ['nullable', new Enum(StatusEnum::class)],
              'category_id' => ['required', 'exists:categories,id'],
        ];
    }
}
