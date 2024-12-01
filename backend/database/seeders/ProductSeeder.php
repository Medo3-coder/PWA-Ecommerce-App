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

        $categories    = ['Electronics', 'Fashion', 'Home Appliances'];
        $subcategories = ['Mobile', 'Laptop', 'Shoes', 'Clothing', 'Kitchen'];

        foreach ($remarks as $remark => $count) {
            for ($i = 0; $i < $count; $i++) {
                DB::table('products')->insert([
                    'title'         => 'Product ' . ($i + 1) . ' (' . $remark . ')',
                    'price'         => rand(100, 1000),
                    'special_price' => rand(50, 900),
                    'image'         => 'https://via.placeholder.com/150?text=Product+' . ($i + 1),
                    'category'      => $categories[array_rand($categories)],
                    'subcategory'   => $subcategories[array_rand($subcategories)],
                    'remark'        => $remark,
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
