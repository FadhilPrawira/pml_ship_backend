<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'role' => 'admin',
            'status' => 'approved',
            'name' => 'Fadhil Prawira',

            'email' => 'fadhilprawira87@gmail.com',
            'password' => Hash::make('password777'),
            'approved_at' => now(),
        ]);
        User::factory()->create([
            'role' => 'customer',
            'status' => 'approved',
            'name' => 'User Test 6',

            'email' => 'user6@example.com',
            'password' => Hash::make('password777'),
            'approved_at' => now(),
        ]);
        User::factory()->create([
            'role' => 'customer',
            'status' => 'approved',
            'name' => 'Dani Sefianto',

            'email' => 'sefiantodani@gmail.com',
            'password' => Hash::make('password777'),
            'approved_at' => now(),
        ]);
        User::factory()->create([
            'role' => 'customer',
            'status' => 'approved',
            'name' => 'Qory Wiljanova',

            'email' => 'qorywiljanova2016@gmail.com',
            'password' => Hash::make('password777'),
            'approved_at' => now(),
        ]);
        // User::factory(50)->create();
    }
}
