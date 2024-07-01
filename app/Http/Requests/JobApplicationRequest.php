<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobApplicationRequest extends FormRequest
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
    public function rules()
    {
        return [
            'full_name' => 'required|string',
            'position' => 'required|string',
            'cover_letter' => 'required|string',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:4000'
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'The fullname field is required.',
            'position.required' => 'The position field is required.',
            'cover_letter.required' => 'The cover_letter field is required.',
            'resume.required' => 'The resume field is required.',
            'resume.mimes' => 'The resume must be a file of type: pdf, doc, docx.',
        ];
    }
}
