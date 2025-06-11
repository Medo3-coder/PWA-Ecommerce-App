<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductStatus;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = ProductCategory::all();
        $statuses = ProductStatus::all();

        // Create 20 products
        for ($i = 0; $i < 20; $i++) {
            $price = fake()->randomFloat(2, 10, 1000);
            $quantity = fake()->numberBetween(0, 100);

            Product::create([
                'name' => fake()->words(3, true),
                'description' => fake()->paragraphs(2, true),
                'price' => $price,
                'quantity' => $quantity,
                'status' => $quantity > 0 ? 'active' : 'inactive',
                'product_category_id' => $categories->random()->id,
            ]);
        }

        $this->command->info('Products seeded successfully!');
    }
}
