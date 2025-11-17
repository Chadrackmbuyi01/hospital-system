<?php

namespace App\Services;

use App\Models\MedicalRecord;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;


class MedicalRecordService
{
    /**
     * Create a new medical record.
     *
     * @param array $data
     * @return MedicalRecord
     */
    public function createMedicalRecord(array $data): MedicalRecord
    {
        return MedicalRecord::create($data);
    }

    /**
     * Update an existing medical record.
     *
     * @param MedicalRecord $medicalRecord
     * @param array $data
     * @return MedicalRecord
     */
    public function updateMedicalRecord(MedicalRecord $medicalRecord, array $data): MedicalRecord
    {
        $medicalRecord->update($data);
        return $medicalRecord;
    }

    /**
     * Delete a medical record.
     *
     * @param MedicalRecord $medicalRecord
     * @return void
     */
    public function deleteMedicalRecord(MedicalRecord $medicalRecord): void
    {
        $medicalRecord->delete();
    }

    /**
     * Get all medical records with their associated patient and doctor.
     *
     * @return Collection
     */
    public function getAllMedicalRecords(): Collection
    {
        return MedicalRecord::with(['patient', 'doctor'])->get();
    }

    /**
     * Get medical records for a specific user.
     *
     * @param User $user
     * @return Collection
     */
    public function getMedicalRecordsByUser(User $user): Collection
    {
        return MedicalRecord::where('patient_id', $user->id)
            ->orWhere('doctor_id', $user->id)
            ->with(['patient', 'doctor'])
            ->get();
    }
}