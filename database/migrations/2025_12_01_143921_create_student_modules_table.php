<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('module_id')->constrained()->onDelete('cascade');
            $table->dateTime('started_at')->nullable();
            $table->dateTime('finished_at')->nullable();
            $table->integer('duration_seconds')->default(0);
            $table->decimal('score', 8, 2)->default(0);
            $table->integer('correct_answers')->default(0);
            $table->integer('wrong_answers')->default(0);
            $table->integer('unanswered')->default(0);
            $table->enum('status', ['not_started', 'in_progress', 'completed', 'abandoned'])->default('not_started');
            $table->integer('attempt_number')->default(1);
            $table->timestamps();

            // Unique constraint untuk mencegah duplikasi attempt yang sama
            $table->unique(['user_id', 'module_id', 'attempt_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_modules');
    }
};