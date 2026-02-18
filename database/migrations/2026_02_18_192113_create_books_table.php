<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */public function up(): void
    {
        // ¡AQUÍ ESTABA EL ERROR! Seguramente ponía 'users'
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->enum('genre', ['Terror', 'Romance', 'Ciencia Ficción', 'Fantasía']);
            $table->text('description');
            $table->string('cover_image')->nullable();
            $table->integer('rating')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
