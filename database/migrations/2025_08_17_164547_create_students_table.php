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
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            // Basic Information (from admission form)
            $table->string('student_id')->unique(); // Custom student ID like LHB001, LHB002
            $table->string('full_name'); // Full name as per form
            $table->date('date_of_birth');
            $table->integer('age_years')->nullable(); // Age in years
            $table->integer('age_months')->nullable(); // Age in months
            $table->enum('gender', ['male', 'female']);
            $table->string('place_of_birth')->nullable();
            $table->string('nationality')->default('Indian');
            $table->string('mother_tongue')->nullable();
            $table->string('blood_group')->nullable();

            // Medical Details
            $table->text('allergies')->nullable();
            $table->text('surgeries')->nullable();
            $table->text('chronic_illness')->nullable();
            $table->boolean('immunization_complete')->default(false);
            $table->text('medical_notes')->nullable(); // Any other medical info

            // Parent relationship (we'll link to parents table)
            $table->foreignId('parent_id')->constrained('parents')->onDelete('cascade');

            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
            $table->foreignId('section_id')->constrained('sections')->onDelete('cascade');

            // Previous School Details
            $table->boolean('attended_school_previously')->default(false);
            $table->string('previous_school_name')->nullable();
            $table->string('previous_school_duration')->nullable();
            $table->string('previous_class_attended')->nullable();

            // Photos
            $table->string('child_photo')->nullable();

            // School Status
            $table->enum('status', ['active', 'inactive', 'graduated', 'withdrawn'])->default('active');
            $table->date('admission_date');

            // Document Submission Status
            $table->string('birth_certificate')->nullable();
            $table->string('immunization_record')->nullable();
            $table->string('transfer_certificate')->nullable();
            $table->string('progress_report')->nullable();
            $table->string('passport')->nullable();
            $table->string('medical_report')->nullable();

            $table->timestamps();

            // Indexes
            $table->index('parent_id');
            $table->index('class_id');
            $table->index('section_id');
            $table->index('status');
            $table->index('student_id');
            $table->index('admission_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
