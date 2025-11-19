<?php
// database/migrations/2024_01_02_fix_users_table_foreign_keys.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // First, make sure departments table exists
        if (!Schema::hasTable('departments')) {
            Schema::create('departments', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->text('description')->nullable();
                $table->foreignId('head_doctor_id')->nullable()->constrained('users')->onDelete('set null');
                $table->string('phone')->nullable();
                $table->string('email')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // Now add the foreign key constraint to users table
        Schema::table('users', function (Blueprint $table) {
            // Check if the column exists but doesn't have the foreign key
            if (Schema::hasColumn('users', 'department_id')) {
                // Remove any existing foreign key first
                $table->dropForeign(['department_id']);
            } else {
                // Add the column if it doesn't exist
                $table->foreignId('department_id')->nullable()->after('license_number');
            }
            
            // Add the foreign key constraint
            $table->foreign('department_id')
                  ->references('id')
                  ->on('departments')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['department_id']);
        });
    }
};