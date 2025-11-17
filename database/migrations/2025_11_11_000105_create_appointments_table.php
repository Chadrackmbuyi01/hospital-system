<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            
            // Foreign keys
            $table->foreignId('patient_id')->constrained('users');
            $table->foreignId('doctor_id')->constrained('users');
            $table->foreignId('department_id')->constrained();
            
            // Date and time
            $table->date('appointment_date');
            $table->time('appointment_time');
            
            // Status - using string with constraint in model
            $table->string('status')->default('scheduled');
            
            // Reason and notes
            $table->text('reason');
            $table->text('notes')->nullable();
            
            // Priority - using string with constraint in model
            $table->string('priority')->default('medium');
            
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['appointment_date', 'doctor_id']);
            $table->index(['patient_id', 'status']);
            $table->index(['department_id', 'appointment_date']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
