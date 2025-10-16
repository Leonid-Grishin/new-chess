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
        Schema::create('camp_about_feature_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('camp_about_feature_id');
            $table->integer('order');
            $table->string('title');

            $table->foreign('camp_about_feature_id')->on('camp_about_features')->references('id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camp_about_feature_items');
    }
};
