<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('about_settings', function (Blueprint $table) {
            $table->id();
            // Hero section
            $table->string('hero_subtitle')->default('Our Story');
            $table->string('hero_title')->default('CRAFTING TASTE SINCE 1995');
            $table->text('hero_intro')->nullable();
            // Vision section
            $table->string('vision_heading')->default('OUR VISION');
            $table->text('vision_text')->nullable();
            $table->string('image_path')->nullable();
            // Values
            $table->string('value1_title')->default('Authenticity');
            $table->text('value1_text')->nullable();
            $table->string('value2_title')->default('Expertise');
            $table->text('value2_text')->nullable();
            // Compliance
            $table->string('compliance_heading')->default('LICENSED & REGULATED');
            $table->text('compliance_quote')->nullable();
            $table->string('cert1')->nullable();
            $table->string('cert2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_settings');
    }
};
