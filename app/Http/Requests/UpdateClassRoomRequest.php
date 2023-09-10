<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClassRoomRequest extends FormRequest
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
            'name' => 'required|string|max:50|unique:class_rooms,name,'.$this->class_room->id,
            'abbr' => 'required|string|max:20|unique:class_rooms,abbr,'.$this->class_room->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The Class Name field is required.',
            'name.string' => 'The Class Name field must be a string.',
            'name.max' => 'The Class Name field may not be greater than :max characters.',
            'name.unique' => 'This Class Name is already exists',
            'abbr.required' => 'The Class Abbreviation field is required.',
            'abbr.string' => 'The Class Abbreviation field must be a string.',
            'abbr.max' => 'The Class Abbreviation field may not be greater than :max characters.',
            'abbr.unique' => 'This Class Abbreviation is already exists',
        ];
    }
}
