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
        Schema::create('camps', function (Blueprint $table) {
            $table->id();
            $table->string('h1');
            $table->string('intro_feature_1')->nullable();
            $table->string('intro_feature_2')->nullable();
            $table->string('intro_feature_3')->nullable();
            $table->string('intro_video_big');
            $table->string('intro_video_short');
            $table->string('intro_video_poster');
            $table->string('about_h2');
            $table->string('date_1')->nullable();
            $table->string('date_2')->nullable();
            $table->string('date_departure')->nullable();
            $table->string('date_duration')->nullable();
            $table->string('schedule_h2');
            $table->string('teachers_h2');
            $table->string('teachers_description');
            $table->string('location_h2');
            $table->string('location_title');
            $table->string('location_address');
            $table->string('location_description');
            $table->string('location_title_2')->nullable();
            $table->string('location_description_2')->nullable();
            $table->string('location_title_3')->nullable();
            $table->string('location_description_3')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camps');
    }
};
