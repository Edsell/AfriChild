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
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('CompanyName')->nullable();
            $table->string('Address')->nullable();
            $table->string('Phone')->nullable();
            $table->string('Phone2')->nullable();
            $table->string('Email')->nullable();
            $table->string('Code')->nullable();     // phone code (+256 etc)
            $table->string('Plot')->nullable();
            $table->string('Country')->nullable();
            $table->string('Currency')->nullable();
            $table->string('Logo')->nullable();     // path
            $table->string('Crumb')->nullable();    // path
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};
