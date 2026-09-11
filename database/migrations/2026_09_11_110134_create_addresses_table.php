<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();

            $table->string('title')
                ->default('Адрес школы шахмат');

            $table->string('name')
                ->nullable();

            $table->text('address')
                ->nullable();

            $table->string('address_link')
                ->nullable();

            $table->string('phone', 50)
                ->nullable();

            $table->string('phone_link', 100)
                ->nullable();

            $table->string('image_1')
                ->nullable();

            $table->string('image_1_alt')
                ->nullable();

            $table->string('image_2')
                ->nullable();

            $table->string('image_2_alt')
                ->nullable();

            $table->unsignedInteger('sort_order')
                ->default(0);

            $table->timestamps();

            $table->index('sort_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
