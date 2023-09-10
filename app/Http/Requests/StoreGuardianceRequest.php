<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuardianceRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'contact' => 'required|max:12|unique:users',
            'sec_contact' => 'required|max:12|unique:guardiances',
            'guardiance_type_id' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'status',
            'roles' => 'required',
            'username' => 'required|string|unique:users,username',
            'nic' => 'required|max:12|unique:guardiances',
        ];
    }

    public function messages()
    {
        return [
            'contact.required' => 'The Default Contact field is required.',
            'contact.max' => 'The Default Contact field may not be greater than :max characters.',
            'contact.unique' => 'This Default Contact is already exists',
            'sec_contact.required' => 'The Contact field is required.',
            'sec_contact.max' => 'The Contact field may not be greater than :max characters.',
            'sec_contact.unique' => 'This Contact is already exists',
            'guardiance_type_id.required' => 'This Type field is required',
            'name.required' => 'The Name field is required.',
            'name.string' => 'The Name field must be a string.',
            'name.max' => 'The Name field may not be greater than :max characters.',
            'email.required' => 'The Email field is required.',
            'email.email' => 'The Email field must be an email.',
            'email.unique' => 'This Email is already exists',
            'password.required' => 'The Password field is required.',
            'password.same' => 'Confirm Password does not match',
            'roles.required' => 'Select a role',
            'username.required' => 'The Username field is required.',
            'username.string' => 'The Username field must be a string.',
            'username.unique' => 'This Username is already exists',
            'nic.required' => 'The NIC / Passport field is required.',
            'nic.max' => 'The NIC field may not be greater than :max characters.',
            'nic.unique' => 'This NIC / Passport is already exists',
        ];
    }
}
