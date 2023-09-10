<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSemesterRequest extends FormRequest
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
            'name' => 'required|string|max:50|unique:semesters,name,'.$this->semester->id,
            'abbr' => 'required|string|max:20|unique:semesters,abbr,'.$this->semester->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The Semester Name field is required.',
            'name.string' => 'The Semester Name field must be a string.',
            'name.max' => 'The Semester Name field may not be greater than :max characters.',
            'name.unique' => 'This Semester Name is already exists',
            'abbr.required' => 'The Semester Abbreviation field is required.',
            'abbr.string' => 'The Semester Abbreviation field must be a string.',
            'abbr.max' => 'The Semester Abbreviation field may not be greater than :max characters.',
            'abbr.unique' => 'This Semester Abbreviation is already exists',
        ];
    }
}
