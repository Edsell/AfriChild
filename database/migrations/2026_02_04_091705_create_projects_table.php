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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            // Core content
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->string('excerpt', 255)->nullable();

            // Images (store relative paths within /public/uploads)
            $table->string('cover')->nullable();         // main grid image
            $table->string('gallery_image')->nullable(); // optional prettyPhoto/lightbox image

            // Links / display
            $table->string('url')->nullable();           // if you want to override route link
            $table->string('client')->nullable();        // optional
            $table->string('location')->nullable();      // optional

            // Dates / ordering
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->unsignedInteger('sort_order')->default(0);

            // SEO (if you have project detail pages)
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();

            // Status
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
