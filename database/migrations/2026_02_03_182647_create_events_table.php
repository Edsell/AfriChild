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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();

            $table->string('excerpt', 255)->nullable();
            $table->longText('description')->nullable();

            $table->date('event_date');
            $table->time('event_time')->nullable();

            $table->string('venue')->nullable();
            $table->string('location')->nullable();

            $table->string('image')->nullable(); 

            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('sort_order')->default(0);

            $table->enum('status', ['draft', 'published'])->default('published');

            $table->timestamps();

            $table->index(['status', 'event_date']);
            $table->index(['is_featured', 'sort_order']);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
