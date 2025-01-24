<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Initialize Faker
        $faker = Faker::create();

        // Create an admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Use a secure password
            'email_verified_at' => now(),
            'profile_photo_path' => null,
        ]);

        // Create 29 regular users
        for ($i = 1; $i <= 29; $i++) {
            User::create([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'password' => Hash::make('password'), // Default password is 'password'
                'email_verified_at' => now(),
                'profile_photo_path' => $faker->optional()->imageUrl(200, 200, 'people'), // Random profile photo URL
            ]);
        }

        $this->command->info('30 users seeded successfully!');
    }
}
