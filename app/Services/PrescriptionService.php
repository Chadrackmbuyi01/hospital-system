<?php

namespace App\Services;

use App\Models\Prescription;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;


class PrescriptionService
{
    /**
     * Create a new prescription.
     *
     * @param array $data
     * @return Prescription
     */
    public function createPrescription(array $data): Prescription
    {
        return Prescription::create($data);
    }

    /**
     * Update an existing prescription.
     *
     * @param Prescription $prescription
     * @param array $data
     * @return Prescription
     */
    public function updatePrescription(Prescription $prescription, array $data): Prescription
    {
        $prescription->update($data);
        return $prescription;
    }

    /**
     * Delete a prescription.
     *
     * @param Prescription $prescription
     * @return void
     */
    public function deletePrescription(Prescription $prescription): void
    {
        $prescription->delete();
    }

    /**
     * Get all prescriptions with their associated patient and doctor.
     *
     * @return Collection
     */
    public function getAllPrescriptions(): Collection
    {
        return Prescription::with(['patient', 'doctor'])->get();
    }

    /**
     * Get prescriptions for a specific user.
     *
     * @param User $user
     * @return Collection
     */
    public function getPrescriptionsByUser(User $user): Collection
    {
        return Prescription::where('patient_id', $user->id)
            ->orWhere('doctor_id', $user->id)
            ->with(['patient', 'doctor'])
            ->get();
    }
}