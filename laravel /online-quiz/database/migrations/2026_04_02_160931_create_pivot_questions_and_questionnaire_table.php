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
        Schema::create('pivot_questions_and_questionnaire', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')
                ->references('id')
                ->on('questions')
                ->onDelete('cascade');
            $table->foreignId('questionnaire_id')
                ->references('id')
                ->on('questionnaire')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivot_questions_and_questionnaire');
    }
};
