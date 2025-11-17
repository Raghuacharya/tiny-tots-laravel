<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->id();

            // Father Details
            $table->string('father_name')->nullable();
            $table->string('father_occupation')->nullable();
            $table->string('father_place_of_work')->nullable();
            $table->text('father_office_address')->nullable();
            $table->string('father_email')->nullable();
            $table->string('father_contact_no')->nullable();
            $table->string('father_photo')->nullable();

            // Mother Details
            $table->string('mother_name')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('mother_place_of_work')->nullable();
            $table->text('mother_office_address')->nullable();
            $table->string('mother_email')->nullable();
            $table->string('mother_contact_no')->nullable();
            $table->string('mother_photo')->nullable();

            // Residential Contact
            $table->text('residential_address')->nullable();
            $table->string('residential_contact')->nullable();

            // Guardian Details (if applicable)
            $table->string('guardian_name')->nullable();
            $table->string('guardian_relationship')->nullable();
            $table->string('guardian_contact')->nullable();

            // Emergency Contact
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_relationship')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->text('emergency_contact_address')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parents');
    }
};

