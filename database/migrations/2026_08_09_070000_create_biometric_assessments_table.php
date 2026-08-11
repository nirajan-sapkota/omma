<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('biometric_assessments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('patient_id')
                ->constrained('patients')
                ->cascadeOnDelete();

            $table->foreignId('booking_id')
                ->unique()
                ->constrained('bookings')
                ->cascadeOnDelete();

            $table->foreignId('tested_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('sight')->nullable();

            $table->string('hearing')->nullable();

            $table->string('speaking')->nullable();

            $table->string('colour_blindness')->nullable();

            $table->string('physical_ability')->nullable();

            $table->string('overall_result')->nullable();

            $table->text('notes')->nullable();

            $table->timestamp('tested_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('biometric_assessments');
    }
};