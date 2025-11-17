<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrescriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
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
            'patient_id' => ['required', 'exists:users,id'],
            'doctor_id' => ['required', 'exists:users,id'],
            'medication' => ['required', 'string', 'max:255'],
            'dosage' => ['required', 'string', 'max:255'],
            'instructions' => ['nullable', 'string'],
            'issued_date' => ['required', 'date'],
            'expiration_date' => ['nullable', 'date', 'after:issued_date'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'patient_id.required' => 'The patient field is required.',
            'patient_id.exists' => 'The selected patient is invalid.',
            'doctor_id.required' => 'The doctor field is required.',
            'doctor_id.exists' => 'The selected doctor is invalid.',
            'medication.required' => 'The medication field is required.',
            'medication.max' => 'The medication may not be greater than :max characters.',
            'dosage.required' => 'The dosage field is required.',
            'dosage.max' => 'The dosage may not be greater than :max characters.',
            'issued_date.required' => 'The issued date field is required.',
            'issued_date.date' => 'The issued date must be a valid date.',
            'expiration_date.date' => 'The expiration date must be a valid date.',
            'expiration_date.after' => 'The expiration date must be after the issued date.',
        ];
    }
}