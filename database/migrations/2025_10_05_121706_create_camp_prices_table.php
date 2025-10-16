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
        Schema::create('camp_prices', function (Blueprint $table) {
            $table->id();
            $table->integer('order');
            $table->string('title');
            $table->string('amount');
            $table->string('description');
            $table->boolean('is_discount')->default(false);
            $table->string('second_amount')->nullable();
            $table->string('second_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camp_prices');
    }
};
