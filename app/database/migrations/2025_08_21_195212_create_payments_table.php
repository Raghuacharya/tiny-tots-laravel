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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            // Link to student
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');

            // Link to fee (defined in fees table)
            $table->foreignId('fee_id')->constrained('fees')->onDelete('cascade');

            // Amount paid
            $table->decimal('amount_paid', 10, 2);

            // Payment date
            $table->date('payment_date')->default(now());

            // Payment mode (cash, card, UPI, cheque, etc.)
            $table->enum('payment_mode', ['cash', 'card', 'upi', 'cheque', 'bank_transfer'])->default('cash');

            // Reference (like cheque no, UPI ID, transaction ID)
            $table->string('reference_no')->nullable();

            // Notes for admin
            $table->text('notes')->nullable();

            $table->timestamps();

            // Prevent duplicate exact records
            $table->unique(['student_id', 'fee_id', 'reference_no'], 'unique_payment_per_reference');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
