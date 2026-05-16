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
        Schema::create('broadcast_channels', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('room_id')->unique();
            $table->integer('owner_id');
            $table->boolean('visibility')->default(0);
            $table->integer('questionnaire_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('broadcast_channels');
    }
};
