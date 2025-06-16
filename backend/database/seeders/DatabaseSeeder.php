<?php
namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->call([
            UserSeeder::class,
            ProductStatusSeeder::class,
            ProductCategorySeeder::class,
            ProductAttributeSeeder::class,
            ProductSeeder::class,
            ProductVariantSeeder::class,
            ProductTagSeeder::class,
            ProductReviewSeeder::class,
            CartSeeder::class,
            ContactSeeder::class,
            SiteSettingSeeder::class,
            SliderSeeder::class
        ]);
    }
}
