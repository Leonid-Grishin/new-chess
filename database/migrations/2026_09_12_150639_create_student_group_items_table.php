<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_group_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_group_id')
                ->constrained('student_groups')
                ->cascadeOnDelete();

            $table->text('text');

            $table->unsignedInteger('sort_order')
                ->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_group_items');
    }
};
