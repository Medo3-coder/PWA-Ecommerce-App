<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $remarks = [
            'Featured'   => 6,
            'New'        => 8,
            'Collection' => 8,
        ];

        $categories    = DB::table('categories')->pluck('id')->toArray();  // Get all category IDs
        $subcategories = DB::table('subcategories')->pluck('id')->toArray(); // Get all subcategory IDs

        foreach ($remarks as $remark => $count) {
            for ($i = 0; $i < $count; $i++) {
                DB::table('products')->insert([
                    'title'         => 'Product ' . ($i + 1) . ' (' . $remark . ')',
                    "description"   => 'This is a description for ' . $remark . ' product '. ($i + 1),
                    'price'         => rand(100, 1000),
                    'is_available'  => rand(1 , 0),
                    'special_price' => rand(50, 900),
                    'image'         => 'https://via.placeholder.com/150?text=Product+' . ($i + 1),
                    'category_id'      => $categories[array_rand($categories)],
                    'subcategory_id'   => $subcategories[array_rand($subcategories)],
                    'remark'        => $remark,
                    'quantity' => rand(1 , 30),
                    'brand'         => 'Brand ' . chr(65 + rand(0, 25)),
                    'star'          => rand(1, 5),
                    'product_code'  => 'CODE-' . strtoupper(uniqid()),
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);
            }
        }
    }

}
