<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Fonepay / eSewa Payment QR Code');
            $table->string('payment_image')->nullable();
            $table->text('instructions')->nullable();
            $table->string('amount')->default('NPR 1,000');
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_settings');
    }
};
