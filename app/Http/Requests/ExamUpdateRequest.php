<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamUpdateRequest extends FormRequest {
    /**
    * Determine if the user is authorized to make this request.
    */

    public function authorize(): bool {
        return true;
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */

    public function messages(): array {
        return [];
    }

    /**
    * Get the validation rules that apply to the request.
    *
    * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
    */

    public function rules(): array {
        return [
            'exam_category_id' => 'required',
            'starting_time' => 'required',
            'ending_time' => 'required',
            'total_marks' => 'required',
            'section_id' => 'required',
            'class_id' => 'required',
            'status' => 'required',
        ];
    }
}
