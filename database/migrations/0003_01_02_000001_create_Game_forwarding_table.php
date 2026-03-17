<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
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
            $table->unsignedSmallInteger("result_one")->nullable();
            $table->unsignedSmallInteger("result_two")->nullable();
            $table->dateTime("date")->nullable();
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
