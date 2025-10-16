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
        Schema::create('camp_gallery_sliders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order');
            $table->string('image_prev')->nullable();
            $table->string('image_big')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camp_gallery_sliders');
    }
};
