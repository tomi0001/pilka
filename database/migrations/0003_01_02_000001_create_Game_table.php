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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_one')->constrained();
            $table->foreign('country_one')->references('id')->on('countries')->onDelete('cascade');
            $table->unsignedBigInteger('country_two')->constrained();
            $table->foreign('country_two')->references('id')->on('countries')->onDelete('cascade');
            $table->unsignedTinyInteger('result_one')->nullable();
            $table->unsignedTinyInteger('result_two')->nullable();
            $table->unsignedTinyInteger('result_over_one')->nullable();
            $table->unsignedTinyInteger('result_over_two')->nullable();
            $table->unsignedTinyInteger('result_pena_one')->nullable();
            $table->unsignedTinyInteger('result_pena_two')->nullable();
            $table->unsignedTinyInteger('type')->default(0);
            $table->dateTime('date')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');

    }
};
