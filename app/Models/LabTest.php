<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LabTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'medical_record_id',
        'test_name',
        'test_type',
        'description',
        'results',
        'result_range',
        'test_date',
        'result_date',
        'status',
        'lab_technician_id',
    ];

    protected $casts = [
        'results' => 'array',
        'test_date' => 'date',
        'result_date' => 'date',
    ];

    // Constants for lab test status
    const STATUS_PENDING = 'pending';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELED = 'canceled';

    // Relationships can be defined here
    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function medicalRecord(): BelongsTo
    {
        return $this->belongsTo(MedicalRecord::class);
    }

    public function labTechnician(): BelongsTo
    {
        return $this->belongsTo(User::class, 'lab_technician_id');
    }
}