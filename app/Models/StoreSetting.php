<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * StoreSetting — Single-row settings model for the store.
 *
 * ARCHITECTURE NOTE (Future Multi-Store Support):
 * -----------------------------------------------
 * Currently designed as a single-row model (always use ::first() or ::find(1)).
 * To support multiple store locations in the future:
 *   1. Rename table to `stores`
 *   2. Add `slug` and `is_primary` columns
 *   3. Replace ::first() calls with ::where('slug', $slug)->first()
 *   4. Update AppServiceProvider to resolve by domain/subdomain
 *   5. All helper methods below remain the same — no changes needed in templates
 */
class StoreSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        // Basic Info
        'store_name',
        'show_name_in_navbar',
        'logo',
        'tagline',
        'footer_text',
        // Structured Address
        'address_line_1',
        'address_line_2',
        'city',
        'county',
        'state',
        'postal_code',
        'country',
        // Legacy (kept for backward compat, use structured fields above)
        'address',
        // Contact
        'phone',
        'secondary_phone',
        'whatsapp',
        'email',
        'business_hours',
        // Social
        'facebook',
        'instagram',
        'google_business',
        // Maps
        'google_map_embed',
        'map_link', // legacy
        // US Compliance
        'license_number',
        'tax_id',
    ];

    /**
     * Get a cleanly formatted full address string.
     * Used in footer, contact page, and JSON-LD schema.
     */
    public function formattedAddress(string $separator = ', '): string
    {
        $parts = array_filter([
            $this->address_line_1,
            $this->address_line_2,
            $this->city,
            $this->state ? "{$this->city}, {$this->state} {$this->postal_code}" : null,
        ]);

        // Build line-by-line for address blocks (street | city state zip)
        $lines = array_filter([
            trim(implode(', ', array_filter([$this->address_line_1, $this->address_line_2]))),
            trim(implode(', ', array_filter([$this->city, $this->state])) . ' ' . $this->postal_code),
            $this->country !== 'US' ? $this->country : 'United States',
        ]);

        return implode("\n", $lines);
    }

    /**
     * Returns a clean WhatsApp URL from any format of phone number.
     * Strips all non-digit characters before building the wa.me link.
     *
     * Usage: $shop->whatsappUrl()
     */
    public function whatsappUrl(): ?string
    {
        if (!$this->whatsapp) {
            return null;
        }
        $digits = preg_replace('/[^0-9]/', '', $this->whatsapp);
        return "https://wa.me/{$digits}";
    }

    /**
     * Get the city/state/zip line (used in footer).
     * e.g. "Granbury, TX 76049"
     */
    public function cityStateLine(): string
    {
        return trim(implode(', ', array_filter([$this->city, $this->state])) . ' ' . $this->postal_code);
    }

    /**
     * Get a clean local phone link for tel: href.
     * Strips formatting for the href, keeps display format.
     */
    public function phoneHref(): ?string
    {
        if (!$this->phone)
            return null;
        return 'tel:+1' . preg_replace('/[^0-9]/', '', $this->phone);
    }
}
