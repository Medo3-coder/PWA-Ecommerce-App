<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->call(SiteSettingSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(SliderSeeder::class);

    }
}
