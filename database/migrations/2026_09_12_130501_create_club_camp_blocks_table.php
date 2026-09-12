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
        Schema::create('club_camp_blocks', function (Blueprint $table) {
            $table->id();

            $table->string('title')
                ->nullable();

            $table->text('description')
                ->nullable();

            $table->string('image_1')
                ->nullable();

            $table->string('image_1_alt')
                ->nullable();

            $table->string('image_2')
                ->nullable();

            $table->string('image_2_alt')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('club_camp_blocks');
    }
};
