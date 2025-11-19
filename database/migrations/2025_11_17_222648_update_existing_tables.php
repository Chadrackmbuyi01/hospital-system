<?php
// database/migrations/2024_01_02_update_existing_tables.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Update users table if it exists
        if (Schema::hasTable('users')) {
            // Add missing columns to users table
            if (!Schema::hasColumn('users', 'role')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->enum('role', ['admin', 'doctor', 'patient', 'receptionist', 'nurse', 'lab_technician'])
                          ->default('patient')
                          ->after('password');
                });
            }

            if (!Schema::hasColumn('users', 'phone')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('phone')->nullable()->after('role');
                });
            }

            if (!Schema::hasColumn('users', 'address')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->text('address')->nullable()->after('phone');
                });
            }

            if (!Schema::hasColumn('users', 'date_of_birth')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->date('date_of_birth')->nullable()->after('address');
                });
            }

            if (!Schema::hasColumn('users', 'gender')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('date_of_birth');
                });
            }

            if (!Schema::hasColumn('users', 'specialization')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('specialization')->nullable()->after('gender');
                });
            }

            if (!Schema::hasColumn('users', 'license_number')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->string('license_number')->nullable()->after('specialization');
                });
            }

            if (!Schema::hasColumn('users', 'department_id')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->unsignedBigInteger('department_id')->nullable()->after('license_number');
                });
            }

            if (!Schema::hasColumn('users', 'is_active')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->boolean('is_active')->default(true)->after('department_id');
                });
            }
        }

        // Create departments table if it doesn't exist
        if (!Schema::hasTable('departments')) {
            Schema::create('departments', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->text('description')->nullable();
                $table->unsignedBigInteger('head_doctor_id')->nullable();
                $table->string('phone')->nullable();
                $table->string('email')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // Create other tables if they don't exist
        $tables = [
            'appointments' => function (Blueprint $table) {
                $table->id();
                $table->foreignId('patient_id')->constrained('users');
                $table->foreignId('doctor_id')->constrained('users');
                $table->foreignId('department_id')->constrained();
                $table->date('appointment_date');
                $table->time('appointment_time');
                $table->enum('status', ['scheduled', 'confirmed', 'completed', 'cancelled', 'no_show'])->default('scheduled');
                $table->text('reason');
                $table->text('notes')->nullable();
                $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
                $table->timestamps();
            },
            'medical_records' => function (Blueprint $table) {
                $table->id();
                $table->foreignId('patient_id')->constrained('users');
                $table->foreignId('doctor_id')->constrained('users');
                $table->foreignId('appointment_id')->nullable()->constrained()->onDelete('set null');
                $table->text('symptoms')->nullable();
                $table->text('diagnosis')->nullable();
                $table->text('treatment')->nullable();
                $table->text('notes')->nullable();
                $table->json('vitals')->nullable();
                $table->json('lab_results')->nullable();
                $table->date('follow_up_date')->nullable();
                $table->timestamps();
            },
            'prescriptions' => function (Blueprint $table) {
                $table->id();
                $table->foreignId('patient_id')->constrained('users');
                $table->foreignId('doctor_id')->constrained('users');
                $table->foreignId('medical_record_id')->constrained();
                $table->string('medication_name');
                $table->string('dosage');
                $table->string('frequency');
                $table->string('duration');
                $table->text('instructions')->nullable();
                $table->date('start_date');
                $table->date('end_date');
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            },
            'lab_tests' => function (Blueprint $table) {
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
            },
            'billings' => function (Blueprint $table) {
                $table->id();
                $table->foreignId('patient_id')->constrained('users');
                $table->foreignId('appointment_id')->nullable()->constrained()->onDelete('set null');
                $table->foreignId('medical_record_id')->nullable()->constrained()->onDelete('set null');
                $table->decimal('amount', 10, 2);
                $table->decimal('discount', 10, 2)->default(0);
                $table->decimal('tax', 10, 2)->default(0);
                $table->decimal('total_amount', 10, 2);
                $table->enum('payment_status', ['pending', 'partial', 'paid', 'overdue'])->default('pending');
                $table->string('payment_method')->nullable();
                $table->json('insurance_details')->nullable();
                $table->date('billing_date');
                $table->date('due_date');
                $table->timestamps();
            }
        ];

        foreach ($tables as $tableName => $blueprint) {
            if (!Schema::hasTable($tableName)) {
                Schema::create($tableName, $blueprint);
            }
        }
    }

    public function down(): void
    {
        // Don't drop tables in down method to avoid data loss
        // You can manually reverse specific changes if needed
    }
};