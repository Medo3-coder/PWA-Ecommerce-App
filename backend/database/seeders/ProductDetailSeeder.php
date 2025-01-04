<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = DB::table('products')->pluck('id')->toArray();

        foreach($products as $productId){
            DB::table('product_details')->insert([
                'product_id' => $productId,
                'image_one' => 'https://via.placeholder.com/150?text=Image+1+for+Product+' . $productId,
                'image_two' => 'https://via.placeholder.com/150?text=Image+2+for+Product+' . $productId,
                'image_three' => 'https://via.placeholder.com/150?text=Image+3+for+Product+' . $productId,
                'image_four' => 'https://via.placeholder.com/150?text=Image+4+for+Product+' . $productId,
                'short_description' => 'Short description for product ' . $productId,
                'color' => ['Red', 'Blue', 'Green', 'Black', 'White'][array_rand(['Red', 'Blue', 'Green', 'Black', 'White'])],
                'size' => ['S', 'M', 'L', 'XL', 'XXL'][array_rand(['S', 'M', 'L', 'XL', 'XXL'])],
                'long_description' => 'This is a detailed long description for product ' . $productId . '. It highlights all the key features and benefits.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
