<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Add structured address & settings fields to store_settings.
 *
 * ARCHITECTURE NOTE (Future Multi-Store):
 * ----------------------------------------
 * Currently uses single-row pattern (id=1) for one store.
 * To support multiple locations in the future:
 *   1. Rename this table to `stores`
 *   2. Remove the single-row constraint
 *   3. Add a `is_primary` boolean column
 *   4. Update AppServiceProvider to query by slug or domain
 *   5. Update all $shop references to use the selected store
 */
return new class extends Migration {
    public function up(): void
    {
        Schema::table('store_settings', function (Blueprint $table) {
            // ── Basic Info ──────────────────────────────────────────────
            $table->string('store_name')->nullable()->after('id');
            $table->string('logo')->nullable()->after('store_name');
            $table->string('tagline')->nullable()->after('logo');

            // ── Structured Address ──────────────────────────────────────
            $table->string('address_line_1')->nullable()->after('tagline');
            $table->string('address_line_2')->nullable()->after('address_line_1');
            $table->string('city')->nullable()->after('address_line_2');
            $table->string('county')->nullable()->after('city');       // e.g. Hood County
            $table->string('state')->nullable()->after('county');      // e.g. TX
            $table->string('postal_code')->nullable()->after('state');
            $table->string('country')->default('US')->after('postal_code');

            // ── Contact ─────────────────────────────────────────────────
            $table->string('secondary_phone')->nullable()->after('phone');
            $table->text('business_hours')->nullable()->after('email');

            // ── Social / Business ───────────────────────────────────────
            $table->string('google_business')->nullable()->after('instagram');
            $table->text('google_map_embed')->nullable()->after('google_business');

            // ── Compliance (US Liquor) ──────────────────────────────────
            $table->string('license_number')->nullable()->after('google_map_embed');
            $table->string('tax_id')->nullable()->after('license_number');

            // ── Deprecated columns kept for safe rollback ───────────────
            // 'address' and 'map_link' are kept but superseded by structured fields above.
        });
    }

    public function down(): void
    {
        Schema::table('store_settings', function (Blueprint $table) {
            $table->dropColumn([
                'store_name',
                'logo',
                'tagline',
                'address_line_1',
                'address_line_2',
                'city',
                'county',
                'state',
                'postal_code',
                'country',
                'secondary_phone',
                'business_hours',
                'google_business',
                'google_map_embed',
                'license_number',
                'tax_id',
            ]);
        });
    }
};
