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
        Schema::create('tourist_attractions', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->text('description');
            $table->string('address');
            $table->text('image_id');
            $table->text('review_id');
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
        Schema::dropIfExists('tourist_attraction');
    }
};
