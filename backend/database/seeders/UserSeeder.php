<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'phone' => '1234567890',
            'password' => 'admin123',
            'role' => 'admin',
            'status' => 'active',
            'email_verified_at' => Carbon::now(),
            'address' => '123 Admin Street',
            'city' => 'Admin City',
            'state' => 'Admin State',
            'country' => 'Admin Country',
            'postal_code' => '00000',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create 10 Regular Users (Customers)
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'password' => Hash::make('user123'),
                'role' => 'user',
                'status' => $faker->randomElement(['active', 'inactive']),
                'email_verified_at' => $faker->optional()->dateTimeThisYear(),
                'address' => $faker->address,
                'city' => $faker->city,
                'state' => $faker->state,
                'country' => $faker->country,
                'postal_code' => $faker->postcode,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
