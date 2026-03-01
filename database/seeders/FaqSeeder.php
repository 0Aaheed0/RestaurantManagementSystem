<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clears existing data to prevent duplicates when re-seeding
        DB::table('faqs')->truncate();

        DB::table('faqs')->insert([
            [
                'question' => 'Do you offer home delivery?',
                'answer' => 'Yes, we provide home delivery within a 5km radius of any of our branches for a small flat fee.'
            ],
            [
                'question' => 'What are your opening hours?',
                'answer' => 'Our branches are open daily from 10:00 AM to 11:00 PM. Last orders are taken 30 minutes before closing.'
            ],
            [
                'question' => 'Do you have vegetarian or vegan options?',
                'answer' => 'Absolutely! We have a dedicated selection of vegetarian burgers and plant-based pizzas available on our menu.'
            ],
            [
                'question' => 'Can I make a reservation for a large group?',
                'answer' => 'Yes, for groups of 6 or more, we recommend booking at least 24 hours in advance through our contact numbers.'
            ],
            [
                'question' => 'Are there any ongoing discounts?',
                'answer' => 'We frequently offer student discounts and weekend "Buy One Get One" deals. Check our home page for the latest offers!'
            ],
            [
                'question' => 'Do you provide catering services for events?',
                'answer' => 'Yes, we offer customized catering packages for birthdays, office parties, and university events.'
            ],
            [
                'question' => 'What payment methods do you accept?',
                'answer' => 'We accept Cash, Credit/Debit cards, and popular mobile banking options like bKash and Nagad.'
            ],
        ]);
    }
}