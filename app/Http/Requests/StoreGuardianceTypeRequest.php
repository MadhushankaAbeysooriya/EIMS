<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuardianceTypeRequest extends FormRequest
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
            'name' => 'required|string|max:20|unique:guardiance_types',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The Guardiance Type Name field is required.',
            'name.string' => 'The Guardiance Type Name field must be a string.',
            'name.max' => 'The Guardiance Type Name field may not be greater than :max characters.',
            'name.unique' => 'This Guardiance Type Name is already exists',
        ];
    }
}
