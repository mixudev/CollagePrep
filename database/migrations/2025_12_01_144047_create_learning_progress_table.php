<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('learning_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->integer('modules_completed')->default(0);
            $table->integer('questions_answered')->default(0);
            $table->decimal('average_score', 8, 2)->default(0);
            $table->integer('study_time_minutes')->default(0);
            $table->timestamps();

            // Unique constraint dan index
            $table->unique(['user_id', 'date']);
            $table->index('date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('learning_progress');
    }
};