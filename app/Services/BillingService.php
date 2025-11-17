<?php

namespace App\Services;

use App\Models\Billing;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;


class BillingService
{
    /**
     * Create a new billing record.
     *
     * @param array $data
     * @return Billing
     */
    public function createBilling(array $data): Billing
    {
        return Billing::create($data);
    }

    /**
     * Update an existing billing record.
     *
     * @param Billing $billing
     * @param array $data
     * @return Billing
     */
    public function updateBilling(Billing $billing, array $data): Billing
    {
        $billing->update($data);
        return $billing;
    }

    /**
     * Delete a billing record.
     *
     * @param Billing $billing
     * @return void
     */
    public function deleteBilling(Billing $billing): void
    {
        $billing->delete();
    }

    /**
     * Get all billing records with their associated patient and services.
     *
     * @return Collection
     */
    public function getAllBillings(): Collection
    {
        return Billing::with(['patient', 'services'])->get();
    }

    /**
     * Get billing records for a specific user.
     *
     * @param User $user
     * @return Collection
     */
    public function getBillingsByUser(User $user): Collection
    {
        return Billing::with(['patient', 'services'])
            ->where('patient_id', $user->id)
            ->orWhere('created_by', $user->id)
            ->get();
    }
}