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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->text('description');
            $table->string('address');
            $table->text('image')->nullable();
            $table->unsignedBigInteger('image_id')->index()->nullable();
            $table->text('review_id')->nullable();
            $table->string('latitude');
            $table->string('longtitude');   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};