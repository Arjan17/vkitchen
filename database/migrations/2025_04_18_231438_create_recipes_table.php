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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id('rid');
            $table->string('name');
            $table->text('description');
            $table->enum('type', ['French', 'Italian', 'Chinese', 'Indian', 'Mexican', 'others']);
            $table->integer('cookingtime');
            $table->text('ingredients');
            $table->text('instructions');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('uid'); // Foreign key

            $table->timestamps();

            $table->foreign('uid')->references('uid')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
