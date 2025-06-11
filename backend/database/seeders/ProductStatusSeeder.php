<?php

namespace Database\Seeders;

use App\Models\ProductStatus;
use Illuminate\Database\Seeder;

class ProductStatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            ['name' => 'Active'],
            ['name' => 'Draft'],
            ['name' => 'Out of Stock'],
            ['name' => 'Discontinued'],
            ['name' => 'Coming Soon'],
        ];

        foreach ($statuses as $status) {
            ProductStatus::create($status);
        }

        $this->command->info('Product statuses seeded successfully!');
    }
}
