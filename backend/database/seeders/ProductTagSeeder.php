<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductTag;
use Illuminate\Database\Seeder;

class ProductTagSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();

        if ($products->isEmpty()) {
            $this->command->warn('No products found! Please seed products first.');
            return;
        }

        // Create 10 tags
        $tags = [
            'New Arrival',
            'Best Seller',
            'Sale',
            'Featured',
            'Limited Edition',
            'Popular',
            'Trending',
            'Clearance',
            'Premium',
            'Exclusive',
        ];

        foreach ($tags as $tagName) {
            ProductTag::create([
                'name' => $tagName,
            ]);
        }

        // Attach 2-4 random tags to each product
        $allTags = ProductTag::all();
        foreach ($products as $product) {
            $tagCount = fake()->numberBetween(2, 4);
            $selectedTags = $allTags->random($tagCount);
            $product->tags()->attach($selectedTags->pluck('id'));
        }

        $this->command->info('Product tags seeded successfully!');
    }
}
