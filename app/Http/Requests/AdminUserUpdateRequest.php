<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserUpdateRequest extends FormRequest
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
        // Get the admin_user ID from the route
        $adminUser = $this->route('admin_user');

        // If route model binding returns a model instance, get the ID
        $adminUserId = $adminUser instanceof \App\Models\AdminUser ? $adminUser->id : $adminUser;

        return [
            'name' => 'required|string|max:50',
            'email' => [
                'required',
                'email',
                Rule::unique('admin_users', 'email')->ignore($adminUserId),
            ],
            'phno' => [
                'required',
                Rule::unique('admin_users', 'phno')->ignore($adminUserId),
            ],
        ];
    }
}
