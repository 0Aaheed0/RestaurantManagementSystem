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
        Schema::table('orders', function (Blueprint $table) {
            // Only add columns if they don't already exist
            if (!Schema::hasColumn('orders', 'delivery_address')) {
                $table->string('delivery_address')->nullable();
            }
            if (!Schema::hasColumn('orders', 'delivery_city')) {
                $table->string('delivery_city')->nullable();
            }
            if (!Schema::hasColumn('orders', 'delivery_postal_code')) {
                $table->string('delivery_postal_code')->nullable();
            }
            if (!Schema::hasColumn('orders', 'delivery_phone')) {
                $table->string('delivery_phone')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'delivery_address')) {
                $table->dropColumn('delivery_address');
            }
            if (Schema::hasColumn('orders', 'delivery_city')) {
                $table->dropColumn('delivery_city');
            }
            if (Schema::hasColumn('orders', 'delivery_postal_code')) {
                $table->dropColumn('delivery_postal_code');
            }
            if (Schema::hasColumn('orders', 'delivery_phone')) {
                $table->dropColumn('delivery_phone');
            }
        });
    }
};
