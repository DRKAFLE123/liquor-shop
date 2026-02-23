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
        Schema::create('heritages', function (Blueprint $table) {
            $table->id();
            $table->string('subtitle')->nullable(); // e.g., Established 1995
            $table->string('title')->nullable();    // e.g., THE MOST TRUSTED NAME...
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('experience_years')->nullable(); // e.g., 25+
            $table->string('experience_text')->nullable();  // e.g., Years of Trust
            $table->string('button_text')->nullable();
            $table->string('button_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heritages');
    }
};
