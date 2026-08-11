<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('payment_receipt')
                ->nullable()
                ->after('meet_link');

            $table->string('payment_reference')
                ->nullable()
                ->after('payment_receipt');

            $table->string('payment_status')
                ->default('pending')
                ->after('payment_reference');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'payment_receipt',
                'payment_reference',
                'payment_status',
            ]);
        });
    }
};
