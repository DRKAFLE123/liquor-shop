<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\StoreSetting::create([
            'address' => '123 Premium Street, Bansbari, Kathmandu, Nepal',
            'phone' => '+977-1-4XXXXXX, +977-98XXXXXXXX',
            'email' => 'info@liquorshop.com.np',
            'whatsapp' => '+97798XXXXXXXX',
            'facebook' => 'https://facebook.com/liquorshop',
            'instagram' => 'https://instagram.com/liquorshop',
            'map_link' => 'https://www.google.com/maps/embed?pb=...',
            'footer_text' => 'Your destination for fine spirits, premium wines, and craft beers. Celebrating quality and taste since 1995.',
        ]);
    }
}
