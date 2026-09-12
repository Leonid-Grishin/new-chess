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
        Schema::create('club_camp_block_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('club_camp_block_id')
                ->constrained('club_camp_blocks')
                ->cascadeOnDelete();

            $table->string('title');

            $table->text('description');

            $table->unsignedInteger('sort_order')
                ->default(0);

            $table->timestamps();

            $table->index([
                'club_camp_block_id',
                'sort_order',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('club_camp_block_items');
    }
};
