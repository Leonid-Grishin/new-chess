<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Создание таблиц.
     */
    public function up(): void
    {
        Schema::create('club_online_blocks', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            /*
             * Хранится только имя файла
             * без пути и расширения.
             */
            $table->string('image')->nullable();

            $table->string('image_alt')->nullable();

            $table->timestamps();
        });

        Schema::create('club_online_block_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('club_online_block_id')
                ->constrained('club_online_blocks')
                ->cascadeOnDelete();

            $table->text('text');

            $table->unsignedInteger('sort_order')
                ->default(0);

            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();

            $table->index([
                'club_online_block_id',
                'sort_order',
            ]);
        });
    }

    /**
     * Удаление таблиц при откате миграции.
     */
    public function down(): void
    {
        Schema::dropIfExists(
            'club_online_block_items'
        );

        Schema::dropIfExists(
            'club_online_blocks'
        );
    }
};
