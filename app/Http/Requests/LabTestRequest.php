<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LabTestRequest extends FormRequest
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
            'test_type' => ['required', 'string', 'max:255'],
            'scheduled_date' => ['required', 'date', 'after:now'],
            'status' => ['required', 'in:pending,completed,cancelled'],
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
            'test_type.required' => 'The test type field is required.',
            'test_type.max' => 'The test type may not be greater than :max characters.',
            'scheduled_date.required' => 'The scheduled date field is required.',
            'scheduled_date.date' => 'The scheduled date must be a valid date.',
            'scheduled_date.after' => 'The scheduled date must be a future date.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The selected status is invalid.',
        ];
    }
}