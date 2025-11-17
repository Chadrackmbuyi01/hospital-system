<?php

namespace App\Services;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class DepartmentService
{
    /**
     * Create a new department.
     *
     * @param array $data
     * @return Department
     */
    public function createDepartment(array $data): Department
    {
        return Department::create($data);
    }

    /**
     * Update an existing department.
     *
     * @param Department $department
     * @param array $data
     * @return Department
     */
    public function updateDepartment(Department $department, array $data): Department
    {
        $department->update($data);
        return $department;
    }

    /**
     * Delete a department.
     *
     * @param Department $department
     * @return void
     */
    public function deleteDepartment(Department $department): void
    {
        $department->delete();
    }

    /**
     * Get all departments with their associated doctors.
     *
     * @return Collection
     */
    public function getAllDepartments(): Collection
    {
        return Department::with('doctors')->get();
    }

    /**
     * Get doctors for a specific department.
     *
     * @param Department $department
     * @return Collection
     */
    public function getDoctorsByDepartment(Department $department): Collection
    {
        return $department->doctors;
    }
}
