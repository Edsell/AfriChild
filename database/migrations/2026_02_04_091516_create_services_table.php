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
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            // Core content
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('excerpt', 255)->nullable();

            // Icons/images (for your feature-box)
            $table->string('icon_class')->nullable();  // e.g. "fa fa-leaf"
            $table->string('image')->nullable();       // optional card image (uploads path)

            // SEO (useful if you have service detail pages)
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();

            // Ordering & status
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
