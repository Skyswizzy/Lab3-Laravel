
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->integer('employee_id')->primary();
            $table->string('first_name', 20)->nullable();
            $table->string('last_name', 25);
            $table->string('email', 100);
            $table->string('phone_number', 20)->nullable();
            $table->date('hire_date');
            $table->integer('job_id');
            $table->decimal('salary', 8, 2);
            $table->integer('manager_id')->nullable();
            $table->integer('department_id')->nullable();

            // Foreign key to jobs
            $table->foreign('job_id')
                  ->references('job_id')
                  ->on('jobs');

            // Foreign key to departments
            $table->foreign('department_id')
                  ->references('department_id')
                  ->on('departments');

            // Self-referencing foreign key to employees
            $table->foreign('manager_id')
                  ->references('employee_id')
                  ->on('employees');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
