<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Appointment;

class AppointmentPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'doctor', 'receptionist']);
    }

    public function view(User $user, Appointment $appointment): bool
    {
        return $user->isAdmin() ||
                $user->id === $appointment->doctor_id ||
                $user->id === $appointment->patient_id ||
                $user->isReceptionist();
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin','receptionist','patient']);
    }

    public function update(User $user, Appointment $appointment): bool
    {
        return $user->isAdmin() ||
                $user->id === $appointment->doctor_id ||
                $user->isReceptionist();
    }

    public function delete(User $user, Appointment $appointment): bool
    {
        return $user->isAdmin() ||
                $user->isReceptionist();
    }
}