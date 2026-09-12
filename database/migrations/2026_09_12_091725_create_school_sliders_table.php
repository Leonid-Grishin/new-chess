<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Запуск миграции.
     */
    public function up(): void
    {
        Schema::create('school_sliders', function (Blueprint $table) {
            $table->id();

            /*
             * Название маленького изображения
             * без пути и расширения.
             *
             * Например:
             * school_slide_abc123
             */
            $table->string('image');

            /*
             * Название большого изображения
             * без пути и расширения.
             *
             * Например:
             * school_slide_big_abc123
             */
            $table->string('image_big');

            $table->string('image_alt')
                ->nullable();

            $table->unsignedInteger('sort_order')
                ->default(0);

            $table->timestamps();

            $table->index('sort_order');
        });
    }

    /**
     * Откат миграции.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_sliders');
    }
};
