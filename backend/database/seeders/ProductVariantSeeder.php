<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class ProductVariantSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        $attributes = ProductAttribute::all();

        if ($products->isEmpty() || $attributes->isEmpty()) {
            $this->command->warn('No products or attributes found! Please seed them first.');
            return;
        }

        // Create 2-4 variants for each product
        foreach ($products as $product) {
            $variantCount = fake()->numberBetween(2, 4);
            $selectedAttributes = $attributes->random($variantCount);

            foreach ($selectedAttributes as $attribute) {
                $value = match($attribute->name) {
                    'Color' => fake()->colorName(),
                    'Size' => fake()->randomElement(['S', 'M', 'L', 'XL', 'XXL']),
                    'Material' => fake()->randomElement(['Cotton', 'Polyester', 'Wool', 'Leather', 'Silk']),
                    'Weight' => fake()->numberBetween(1, 10) . ' kg',
                    'Dimensions' => fake()->numberBetween(10, 100) . 'x' . fake()->numberBetween(10, 100) . 'x' . fake()->numberBetween(10, 100) . ' cm',
                    'Brand' => fake()->company(),
                    'Model' => fake()->bothify('MOD-####'),
                    'Style' => fake()->randomElement(['Casual', 'Formal', 'Sport', 'Vintage', 'Modern']),
                    'Pattern' => fake()->randomElement(['Solid', 'Striped', 'Floral', 'Geometric', 'Abstract']),
                    'Capacity' => fake()->numberBetween(1, 100) . 'L',
                    default => fake()->word(),
                };

                ProductVariant::create([
                    'product_id' => $product->id,
                    'product_attribute_id' => $attribute->id,
                    'value' => $value,
                    'additional_price' => fake()->randomFloat(2, 0, 100),
                    'quantity' => fake()->numberBetween(0, 50),
                ]);
            }
        }

        $this->command->info('Product variants seeded successfully!');
    }
}
