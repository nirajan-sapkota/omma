<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('category')
                ->default('physical')
                ->after('user_id');

            $table->string('service_name')
                ->default('Biometric & Physical Ability Assessment')
                ->after('category');

            $table->string('meet_link')
                ->nullable()
                ->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'category',
                'service_name',
                'meet_link',
            ]);
        });
    }
};