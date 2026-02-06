<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hero_slides', function (Blueprint $table) {
            $table->id();
            // Text content
            $table->string('kicker')->nullable();   // small line above title
            $table->string('title')->nullable();    // main title
            $table->string('subtitle')->nullable(); // supporting line

            // Images (store relative paths within /public/uploads)
            $table->string('background')->nullable(); // main slide bg image
            $table->string('thumb')->nullable();      // optional thumb for slider

            // Button / CTA
            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();
            $table->string('button_bg', 20)->nullable(); // e.g. "#DB1E82"

            // Slider behavior
            $table->unsignedInteger('duration_ms')->nullable(); // e.g. 8970

            // Status
            $table->boolean('is_active')->default(true);

            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_slides');
    }
};
