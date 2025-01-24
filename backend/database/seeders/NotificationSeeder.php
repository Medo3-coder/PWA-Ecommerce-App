<?php

namespace Database\Seeders;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class NotificationSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run() {

        $faker = Faker::create();

        $users = User::all();

        // If no users exist, create a test user
        if ($users->isEmpty()) {
            $user = User::create([
                'name'     => 'Test User',
                'email'    => 'test@example.com',
                'password' => bcrypt('password'),
            ]);
            $users = collect([$user]);
        }

        // Create notifications for each user
        foreach ($users as $user) {
            Notification::create([
                'title'           => 'Welcome to Our Application',
                'message'         => 'Thank you for joining us, ' . $user->name . '!',
                'is_read'         => $faker->boolean,
                'read_at'         => $faker->boolean ? $faker->dateTimeThisYear() : null,
                'notifiable_id'   => $user->id,
                'notifiable_type' => User::class,
            ]);

            Notification::create([
                'title'           => 'New Feature Released',
                'message'         => 'Check out the latest features in our application.',
                'is_read'         => $faker->boolean,
                'read_at'         => $faker->boolean ? $faker->dateTimeThisYear() : null,
                'notifiable_id'   => $user->id,
                'notifiable_type' => User::class,
            ]);
        }

        $this->command->info('Notifications seeded successfully!');
    }

}
