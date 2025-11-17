<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
            'doctor_id' => ['required', 'exists:users,id'],
            'patient_id' => ['required', 'exists:users,id'],
            'appointment_date' => ['required', 'date', 'after:now'],
            'status' => ['required', 'in:scheduled,completed,cancelled'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'doctor_id.required' => 'The doctor field is required.',
            'doctor_id.exists' => 'The selected doctor is invalid.',
            'patient_id.required' => 'The patient field is required.',
            'patient_id.exists' => 'The selected patient is invalid.',
            'appointment_date.required' => 'The appointment date field is required.',
            'appointment_date.date' => 'The appointment date must be a valid date.',
            'appointment_date.after' => 'The appointment date must be a future date.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The selected status is invalid.',
        ];
    }
}