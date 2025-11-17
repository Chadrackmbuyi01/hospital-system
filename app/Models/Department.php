<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'head_doctor_id',
        'phone',
        'email',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationships
    public function headDoctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'head_doctor_id');
    }

    public function doctors(): HasMany
    {
        return $this->hasMany(User::class)->where('role', 'doctor');
    }

    public function staff(): HasMany
    {
        return $this->hasMany(User::class)->whereIn('role', ['doctor', 'nurse', 'receptionist']);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

}