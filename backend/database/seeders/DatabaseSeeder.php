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
            SiteContentSeeder::class,
            SiteSettingSeeder::class,
            UserSeeder::class,
            CategoriesSeeder::class,
            ProductSeeder::class,
            SliderSeeder::class,
            ProductDetailSeeder::class,
            NotificationSeeder::class,
            ReviewsTableSeeder::class,
            CartItemSeeder::class,
        ]);
    }
}
