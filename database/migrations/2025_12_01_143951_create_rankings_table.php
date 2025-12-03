<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rankings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('module_id')->nullable()->constrained()->onDelete('cascade');
            $table->enum('ranking_type', ['module', 'global'])->default('module');
            $table->integer('rank')->default(0);
            $table->decimal('score', 8, 2)->default(0);
            $table->decimal('average_score', 8, 2)->default(0);
            $table->integer('total_modules_completed')->default(0);
            $table->timestamps();

            // Index untuk query cepat
            $table->index(['ranking_type', 'rank']);
            $table->index(['module_id', 'rank']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rankings');
    }
};