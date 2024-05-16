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
            'name' => 'Fadhil Prawira',
            'phone' => '085231806161',
            'email' => 'fadhilprawira87@gmail.com',
            'password' => Hash::make('password777'),
        ]);
        User::factory()->create([
            'role' => 'user',
            'name' => 'User Test',

            'email' => 'user6@example.com',
            'password' => Hash::make('password777'),
        ]);
        User::factory()->create([
            'role' => 'user',
            'name' => 'Dani Sefianto',
            'phone' => '081617708604',
            'email' => 'sefiantodani@gmail.com',
            'password' => Hash::make('password777'),
        ]);
        User::factory()->create([
            'role' => 'user',
            'name' => 'Qory Wiljanova',
            'phone' => '081363601166',
            'email' => 'qorywiljanova2016@gmail.com',
            'password' => Hash::make('password777'),
        ]);
        User::factory(50)->create();
    }
}
