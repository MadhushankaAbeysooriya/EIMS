<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
            'admission' => 'required|string|max:100|unique:students,admission,'.$this->student->id,
            'name_initials' => 'required|string|max:150',
            'full_name' => 'string|max:255',
            'dob' => 'date|before:today', // Date should be before to the current date.
            'gender' => 'required',
            'enlist_date' => 'date|before_or_equal:today', // Date should be before or equal to the current date.
            'address' => 'string|max:500',
            'status'
        ];
    }

    public function messages()
    {
        return [
            'admission.required' => 'The admission field is required.',
            'admission.string' => 'The admission field must be a string.',
            'admission.max' => 'The admission field may not be greater than :max characters.',
            'admission.unique' => 'This admission is already exists',
            'name_initials.required' => 'The Name(with initials) field is required.',
            'name_initials.string' => 'The Name(with initials) field must be a string.',
            'name_initials.max' => 'The Name(with initials) field may not be greater than :max characters.',
            'dob.date' => 'The Date of Birth must be a valid date.',
            'dob.before' => 'The birthdate must be before or equal to today.',
            'gender.required' => 'The Gender field is required.',
            'enlist_date.date' => 'The Enlisted Date must be a valid date.',
            'enlist_date.before_or_equal' => 'The Enlisted Date must be before or equal to today.',
            'address.string' => 'The Address field must be a string.',
            'address.max' => 'The Address field may not be greater than :max characters.',
        ];
    }
}
