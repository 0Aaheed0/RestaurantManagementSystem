<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VoucherSeeder extends Seeder
{
    public function run()
    {
        // Don't truncate if there are existing orders with vouchers
        // Just check if vouchers already exist
        if (DB::table('vouchers')->count() == 0) {
            DB::table('vouchers')->insert([
                [
                    'code' => 'WELCOME10',
                    'discount' => 10,
                    'type' => 'percentage',
                    'valid_until' => now()->addMonths(3),
                    'uses' => 0,
                    'max_uses' => 100,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'code' => 'FLAT50',
                    'discount' => 50,
                    'type' => 'fixed',
                    'valid_until' => now()->addMonths(2),
                    'uses' => 0,
                    'max_uses' => 50,
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'code' => 'SPRING20',
                    'discount' => 20,
                    'type' => 'percentage',
                    'valid_until' => now()->addMonths(1),
                    'uses' => 0,
                    'max_uses' => 200,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            ]);
        }
    }
}