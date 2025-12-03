<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_analytics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->integer('total_questions_attempted')->default(0);
            $table->integer('total_correct')->default(0);
            $table->integer('total_wrong')->default(0);
            $table->decimal('accuracy_percentage', 5, 2)->default(0);
            $table->decimal('average_score', 8, 2)->default(0);
            $table->integer('total_time_spent_seconds')->default(0);
            $table->decimal('average_time_per_question', 8, 2)->default(0);
            $table->integer('strong_topics')->default(0); // Jumlah topik yang dikuasai
            $table->integer('weak_topics')->default(0); // Jumlah topik yang lemah
            $table->timestamps();

            // Unique constraint
            $table->unique(['user_id', 'category_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_analytics');
    }
};