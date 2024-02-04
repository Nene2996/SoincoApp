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
        Schema::create('bird_closures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ancestor_bird_id');
            $table->foreign('ancestor_bird_id')->references('id')->on('birds');
            $table->unsignedBigInteger('descendant_bird_id');
            $table->foreign('descendant_bird_id')->references('id')->on('birds');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bird_closures');
    }
};
