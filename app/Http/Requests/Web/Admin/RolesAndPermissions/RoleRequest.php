<?php

namespace App\Http\Requests\Web\Admin\RolesAndPermissions;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:roles,name,',
            'status' => 'required|in:active,inactive',
            'permissions' => 'nullable|array',
'permissions.*' => 'exists:permissions,id',

        ];
    }

}
