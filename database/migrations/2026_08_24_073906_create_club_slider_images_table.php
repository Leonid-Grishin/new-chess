<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('club_slider_images', function (Blueprint $table) {
            $table->id();
            $table->string('filename');              // имя файла, напр. photo1.jpg
            $table->string('alt')->nullable();       // alt-текст
            $table->integer('sort')->default(0);     // порядок сортировки
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('club_slider_images');
    }
};
