<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    DB::table('faqs')->insert([
        [
            'question' => 'Do you offer home delivery?',
            'answer' => 'Yes, we deliver within 5km radius.'
        ],
        [
            'question' => 'What are your opening hours?',
            'answer' => 'We are open from 10AM to 11PM.'
        ]
    ]);
}
}
