<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductDetailSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $products = DB::table('products')->pluck('id')->toArray();

        foreach ($products as $productId) {
            DB::table('product_details')->insert([
                'product_id'        => $productId,
                'image_one'         => 'https://picsum.photos/150?random=' . $productId,
                'image_two'         => 'https://picsum.photos/150?random=' . ($productId + 1),
                'image_three'       => 'https://picsum.photos/150?random=' . ($productId + 2),
                'image_four'        => 'https://picsum.photos/150?random=' . ($productId + 3),
                'short_description' => 'Short description for product ' . $productId,
                'color'             => ['Red', 'Blue', 'Green', 'Black', 'White'][array_rand(['Red', 'Blue', 'Green', 'Black', 'White'])],
                'size'              => ['S', 'M', 'L', 'XL', 'XXL'][array_rand(['S', 'M', 'L', 'XL', 'XXL'])],
                'long_description'  => 'This is a detailed long description for product ' . $productId . '. It highlights all the key features and benefits.',
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }
    }
}
