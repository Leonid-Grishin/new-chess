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
        Schema::create('promos', function (Blueprint $table) {
            $table->id();

            /*
             * В базе хранится только имя файла без:
             * - пути;
             * - расширения.
             *
             * Например:
             * promo_abc123
             */
            $table->string('image')
                ->nullable();

            $table->string('image_alt')
                ->nullable();

            $table->string('title');

            $table->text('description')
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
        Schema::dropIfExists('promos');
    }
};
