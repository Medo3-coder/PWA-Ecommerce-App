<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $users = User::all();

        // If no users exist, create test users
        if ($users->isEmpty()) {
            $users = User::factory(5)->create();
        }

        $statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
        $paymentStatuses = ['unpaid', 'paid', 'refunded'];
        $paymentMethods = ['credit_card', 'debit_card', 'paypal', 'bank_transfer', 'cash_on_delivery'];

        // Create orders for each user
        foreach ($users as $user) {
            for ($i = 0; $i < 5; $i++) {
                $totalAmount = $faker->numberBetween(50, 500);

                Order::create([
                    'user_id' => $user->id,
                    'order_number' => 'ORD-' . strtoupper(substr(uniqid('', true), 0, 12)),
                    'status' => $faker->randomElement($statuses),
                    'payment_status' => $faker->randomElement($paymentStatuses),
                    'total_amount' => $totalAmount,
                    'payment_method' => $faker->randomElement($paymentMethods),
                    'shipping_address' => $faker->address,
                    'billing_address' => $faker->address,
                    'notes' => $faker->optional()->text(100),
                    'shipped_at' => $faker->optional(0.7)->dateTimeThisYear(),
                    'delivered_at' => $faker->optional(0.5)->dateTimeThisYear(),
                    'created_at' => $faker->dateTimeThisYear(),
                    'updated_at' => $faker->dateTimeThisYear(),
                ]);
            }
        }
    }
}
