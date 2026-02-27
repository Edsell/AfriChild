<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cta_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('cta_section_id')
                ->constrained('cta_sections')
                ->cascadeOnDelete();

            $table->string('title', 255);

            // 0..100 aligns with controller validation
            $table->unsignedTinyInteger('percent')->default(50);

            // >= 0 aligns with controller validation
            $table->unsignedInteger('sort_order')->default(0);

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // helpful for ordering queries per section
            $table->index(['cta_section_id', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cta_items');
    }
};