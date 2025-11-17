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
        Schema::create('lab_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users');
            $table->foreignId('doctor_id')->constrained('users');
            $table->foreignId('medical_record_id')->constrained();
            $table->foreignId('lab_technician_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('test_name');
            $table->string('test_type');
            $table->text('description')->nullable();
            $table->json('results')->nullable();
            $table->string('normal_range')->nullable();
            $table->dateTime('test_date');
            $table->dateTime('result_date')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();

            $table->index(['patient_id', 'test_date']);
            $table->index('status');
            $table->index('lab_technician_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_tests');
    }
};
