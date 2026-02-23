<?php

namespace Database\Seeders;

use App\Models\AboutSetting;
use Illuminate\Database\Seeder;

class AboutSettingSeeder extends Seeder
{
    public function run(): void
    {
        AboutSetting::firstOrCreate(['id' => 1], [
            'hero_subtitle' => 'Our Story',
            'hero_title' => 'CRAFTING TASTE SINCE 1995',
            'hero_intro' => 'From a small boutique store to Kathmandu\'s most trusted destination for premium spirits.',
            'vision_heading' => 'OUR VISION',
            'vision_text' => 'We believe that every bottle tells a story—of the earth it came from, the hands that crafted it, and the moments it celebrates. Our vision is to be the bridge between global heritage and local connoisseurs.',
            'image_path' => null,
            'value1_title' => 'Authenticity',
            'value1_text' => 'Every bottle in our shop is 100% authentic and ethically sourced.',
            'value2_title' => 'Expertise',
            'value2_text' => 'Our staff are trained to help you find the perfect match for any occasion.',
            'compliance_heading' => 'LICENSED & REGULATED',
            'compliance_quote' => 'We operate with the highest standards of integrity and comply with all local liquor licensing regulations. We are committed to promoting responsible drinking across Nepal.',
            'cert1' => 'ISO 9001 Certified',
            'cert2' => 'Beverage Association Member',
        ]);
    }
}
