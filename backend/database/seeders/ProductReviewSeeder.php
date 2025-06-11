<?php
namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductReview;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductReviewSeeder extends Seeder
{
    public function run(): void
    {
        $users    = User::where('role', 'user')->get();
        $products = Product::all();

        if ($users->isEmpty() || $products->isEmpty()) {
            $this->command->warn('No users or products found! Please seed them first.');
            return;
        }

        // Create 3-5 reviews for each product
        foreach ($products as $product) {
            $reviewCount = fake()->numberBetween(3, 5);

            for ($i = 0; $i < $reviewCount; $i++) {
                ProductReview::create([
                    'user_id'    => $users->random()->id,
                    'product_id' => $product->id,
                    'rating'     => fake()->numberBetween(1, 5),
                    'comment'    => fake()->paragraph(),
                ]);
            }
        }
        $this->command->info('Product reviews seeded successfully!');
    }
}
