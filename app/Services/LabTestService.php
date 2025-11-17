<?php

namespace App\Services;

use App\Models\LabTest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class LabTestService
{
    /**
     * Create a new lab test record.
     *
     * @param array $data
     * @return LabTest
     */
    public function createLabTest(array $data): LabTest
    {
        return LabTest::create($data);
    }

    /**
     * Update an existing lab test record.
     *
     * @param LabTest $labTest
     * @param array $data
     * @return LabTest
     */
    public function updateLabTest(LabTest $labTest, array $data): LabTest
    {
        $labTest->update($data);
        return $labTest;
    }

    /**
     * Delete a lab test record.
     *
     * @param LabTest $labTest
     * @return void
     */
    public function deleteLabTest(LabTest $labTest): void
    {
        $labTest->delete();
    }

    /**
     * Get all lab test records with their associated patient and results.
     *
     * @return Collection
     */
    public function getAllLabTests(): Collection
    {
        return LabTest::with(['patient', 'results'])->get();
    }

    /**
     * Get lab test records for a specific user.
     *
     * @param User $user
     * @return Collection
     */
    public function getLabTestsByUser(User $user): Collection
    {
        return LabTest::where('user_id', $user->id)->with(['patient', 'results'])->get();
    }
}