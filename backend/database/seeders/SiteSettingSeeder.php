<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            'address' => "<p>Phone: <a href=\"tel:+021120290147\">+02 01120290147</a></p><p>Email: <a href=\"mailto:medofarouk007@gmail.com\">medofarouk007@gmail.com</a></p>",
            'android_app_link' => "https://play.google.com/store/apps",
            'ios_app_link' => "https://apps.apple.com/us/app",
            'facebook_link' => "https://www.facebook.com",
            'twitter_link' => "https://twitter.com",
            'instagram_link' => "https://www.instagram.com",
            'copyright_text' => "© 2024 Company Name. All rights reserved.",
            'default_image' => 'default.jpg',
        ];

        foreach ($settings as $key => $value) {
            DB::table('site_settings')->insert([
                'key' => $key,
                'value' => $value
            ]);
        }
    }
}
