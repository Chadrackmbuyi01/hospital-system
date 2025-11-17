<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class AppoitmentService
{
    /**
     * Create a new appointment.
     *
     * @param array $data
     * @return Appointment
     */
    public function createAppointment(array $data): Appointment
    {
        return Appointment::create($data);
    }

    /**
     * Update an existing appointment.
     *
     * @param Appointment $appointment
     * @param array $data
     * @return Appointment
     */
    public function updateAppointment(Appointment $appointment, array $data): Appointment
    {
        $appointment->update($data);
        return $appointment;
    }

    /**
     * Delete an appointment.
     *
     * @param Appointment $appointment
     * @return void
     */
    public function deleteAppointment(Appointment $appointment): void
    {
        $appointment->delete();
    }

    /**
     * Get all appointments with their doctor information.
     *
     * @return Collection
     */
    public function getAllAppointments(): Collection
    {
        return Appointment::with('doctor')->get();
    }

    /**
     * Get appointments for a specific user.
     *
     * @param User $user
     * @return Collection
     */
    public function getAppointmentsByUser(User $user): Collection
    {
        return Appointment::where('user_id', $user->id)->with('doctor')->get();
    }

    /**
     * Find an appointment by ID.
     *
     * @param int $id
     * @return Appointment|null
     */
    public function findAppointmentById(int $id): ?Appointment
    {
        return Appointment::with('doctor')->find($id);
    }
}