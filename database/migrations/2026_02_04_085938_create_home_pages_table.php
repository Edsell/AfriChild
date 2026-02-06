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
        Schema::create('home_pages', function (Blueprint $table) {
            $table->id();
               $table->string('title')->nullable();
            $table->string('slug')->default('home')->unique();

            // SEO
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();

            // HERO section heading (optional if slides carry the text)
            $table->string('hero_title')->nullable();
            $table->string('hero_subtitle')->nullable();
            $table->string('hero_button_text')->nullable();
            $table->string('hero_button_url')->nullable();

            // SERVICES section settings
            $table->string('services_title')->nullable();
            $table->string('services_subtitle')->nullable();
            $table->string('services_button_text')->nullable();
            $table->string('services_button_url')->nullable();

            // PROJECTS section settings
            $table->string('projects_title')->nullable();
            $table->string('projects_subtitle')->nullable();
            $table->string('projects_button_text')->nullable();
            $table->string('projects_button_url')->nullable();

            // Optional: toggle sections without deleting data
            $table->boolean('show_hero')->default(true);
            $table->boolean('show_services')->default(true);
            $table->boolean('show_projects')->default(true);

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
        Schema::dropIfExists('home_pages');
    }
};
