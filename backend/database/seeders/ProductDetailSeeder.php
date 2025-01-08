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
        $colors = ['Red', 'Blue', 'Green', 'Black', 'White'];
        $sizes = ['S', 'M', 'L', 'XL', 'XXL'];


        foreach ($products as $productId) {
            $randomColors = array_intersect_key($colors, array_flip(array_rand($colors, 3)));

            $randomSizes = array_intersect_key($sizes , array_flip(array_rand($sizes, 3)));
            DB::table('product_details')->insert([
                'product_id'        => $productId,
                'image_one'         => 'https://picsum.photos/150?random=' . $productId,
                'image_two'         => 'https://picsum.photos/150?random=' . ($productId + 1),
                'image_three'       => 'https://picsum.photos/150?random=' . ($productId + 2),
                'image_four'        => 'https://picsum.photos/150?random=' . ($productId + 3),
                'short_description' => 'Short description for product ' . $productId,
                'color'             => json_encode(array_values($randomColors)), // Store colors as a JSON array
                'size'              => json_encode(array_values($randomSizes)), // Store sizes as a JSON array
                'long_description'  => 'This is a detailed long description for product ' . $productId . '. It highlights all the key features and benefits.',
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }
    }
}
/*
Random Keys: array_rand($colors, 3) picks 3 random indices (e.g., [0, 2, 4]).
Flip Keys: array_flip(array_rand($colors, 3)) converts [0, 2, 4] to [0 => 0, 2 => 2, 4 => 4].
Filter by Keys: array_intersect_key($colors, array_flip(array_rand($colors, 3))) gives the colors corresponding to the random keys (e.g., ['Red', 'Green', 'White']).
Convert to JSON: json_encode(...) converts the array to a JSON string for storage (e.g., ["Red","Green","White"]).
*/
