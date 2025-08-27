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
            RolePermissionSeeder::class,
            UserSeeder::class,

            // Then other data
            ProductStatusSeeder::class,
            ProductCategorySeeder::class,
            ProductAttributeSeeder::class,
            SectionSeeder::class,
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
