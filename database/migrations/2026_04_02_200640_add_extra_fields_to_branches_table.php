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
        Schema::table('branches', function (Blueprint $table) {
            $table->string('email')->nullable()->after('phone');
            $table->boolean('has_wifi')->default(true)->after('map_link');
            $table->boolean('has_ac')->default(true)->after('has_wifi');
            $table->boolean('has_parking')->default(true)->after('has_ac');
            $table->boolean('is_open')->default(true)->after('has_parking');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->dropColumn(['email', 'has_wifi', 'has_ac', 'has_parking', 'is_open']);
        });
    }
};
