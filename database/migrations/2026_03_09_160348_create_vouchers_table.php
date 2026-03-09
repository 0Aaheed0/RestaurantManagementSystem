<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();       // Voucher code
            $table->decimal('discount', 5, 2);      // Discount amount (percentage or fixed)
            $table->enum('type', ['percentage','fixed'])->default('percentage'); // Type of discount
            $table->date('valid_until');            // Expiry date
            $table->integer('uses')->default(0);    // How many times used
            $table->integer('max_uses')->default(1);// Max uses allowed
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};