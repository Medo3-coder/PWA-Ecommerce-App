<?php
namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run() {
        // Insert default slider records
        Slider::insert([
            [
                'image'      => "slider1.jpg",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image'      => "slider2.jpg",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'image'      => "slider3.jpg",
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
