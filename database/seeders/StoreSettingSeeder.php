<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StoreSettingSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\StoreSetting::updateOrCreate(
            ['id' => 1], // Always update the single settings row
            [
                // ── Basic Info ─────────────────────────────────────────
                'store_name' => '51ST LIQUOR AND WINE',
                'tagline' => 'Your neighborhood premium spirits & wine destination in Granbury, TX.',
                'footer_text' => 'Serving Granbury and Hood County with a curated selection of premium spirits, wines, and beers. Must be 21+ to purchase alcohol.',

                // ── Structured Address ─────────────────────────────────
                'address_line_1' => '801 Weatherford Hwy',
                'address_line_2' => 'Suite B',
                'city' => 'Granbury',
                'county' => 'Hood County',
                'state' => 'TX',
                'postal_code' => '76049',
                'country' => 'US',

                // ── Legacy (kept for backward compat) ──────────────────
                'address' => '801 Weatherford Hwy, Suite B, Granbury, TX 76049',

                // ── Contact ────────────────────────────────────────────
                'phone' => '(817) 579-5151',
                'secondary_phone' => null,
                'whatsapp' => '+18175795151',
                'email' => 'info@51stliquorandwine.com',
                'business_hours' => "Mon–Thu: 10:00 AM – 9:00 PM\nFri–Sat: 10:00 AM – 10:00 PM\nSun: 12:00 PM – 8:00 PM",

                // ── Social ─────────────────────────────────────────────
                'facebook' => null,
                'instagram' => null,
                'google_business' => null,

                // ── Maps ───────────────────────────────────────────────
                'google_map_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3345.0!2d-97.79!3d32.44!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2s801+Weatherford+Hwy+Granbury+TX!5e0!3m2!1sen!2sus!4v1" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'map_link' => null, // legacy

                // ── US Compliance ──────────────────────────────────────
                'license_number' => null, // Add TABC license via admin
                'tax_id' => null,
            ]
        );
    }
}
