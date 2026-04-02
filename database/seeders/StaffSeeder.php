<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $staffMembers = [
            [
                'full_name' => 'Md. Yousha',
                'email' => 'yousha.cse@aust.edu',
                'phone' => '01712345678',
                'position' => 'Manager',
                'joined_at' => Carbon::now()->subMonths(10),
            ],
            [
                'full_name' => 'Miraz Hossain',
                'email' => 'miraz.cse@aust.edu',
                'phone' => '01812345678',
                'position' => 'Senior Chef',
                'joined_at' => Carbon::now()->subMonths(8),
            ],
            [
                'full_name' => 'Noman Ahmed',
                'email' => 'noman.cse@aust.edu',
                'phone' => '01912345678',
                'position' => 'Waiter',
                'joined_at' => Carbon::now()->subMonths(5),
            ],
            [
                'full_name' => 'Aaheed Rahman',
                'email' => 'aaheed.cse@aust.edu',
                'phone' => '01612345678',
                'position' => 'Cashier',
                'joined_at' => Carbon::now()->subMonths(3),
            ],
            [
                'full_name' => 'Sakib Al Hasan',
                'email' => 'sakib@example.com',
                'phone' => '01512345678',
                'position' => 'Delivery Rider',
                'joined_at' => Carbon::now()->subMonths(2),
            ],
            [
                'full_name' => 'Tamim Iqbal',
                'email' => 'tamim@example.com',
                'phone' => '01412345678',
                'position' => 'Junior Chef',
                'joined_at' => Carbon::now()->subMonths(1),
            ],
            [
                'full_name' => 'Mushfiqur Rahim',
                'email' => 'mushfiq@example.com',
                'phone' => '01312345678',
                'position' => 'Security Guard',
                'joined_at' => Carbon::now()->subWeeks(3),
            ],
            [
                'full_name' => 'Mahmudullah Riyad',
                'email' => 'riyad@example.com',
                'phone' => '01212345678',
                'position' => 'Manager Assistant',
                'joined_at' => Carbon::now()->subWeeks(2),
            ],
            [
                'full_name' => 'Mustafizur Rahman',
                'email' => 'fizz@example.com',
                'phone' => '01112345678',
                'position' => 'Waiter',
                'joined_at' => Carbon::now()->subWeeks(1),
            ],
            [
                'full_name' => 'Liton Das',
                'email' => 'liton@example.com',
                'phone' => '01012345678',
                'position' => 'Dishwasher',
                'joined_at' => Carbon::now()->subDays(3),
            ],
        ];

        foreach ($staffMembers as $staff) {
            DB::insert('INSERT INTO staff (full_name, email, phone, position, joined_at, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?)', [
                $staff['full_name'],
                $staff['email'],
                $staff['phone'],
                $staff['position'],
                $staff['joined_at'],
                now(),
                now(),
            ]);
        }
    }
}
