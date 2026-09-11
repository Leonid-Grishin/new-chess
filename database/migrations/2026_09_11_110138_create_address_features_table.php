<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('address_features', function (Blueprint $table) {
            $table->id();

            $table->foreignId('address_id')
                ->constrained('addresses')
                ->cascadeOnDelete();

            $table->string('title');

            $table->text('description');

            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();

            $table->index([
                'address_id',
                'is_active',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('address_features');
    }
};
