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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('slug', 100)->unique('books_slug_unique');
            $table->string('author', 100);
            $table->string('publisher', 100);
            $table->string('year', 4);
            $table->integer('stock')->default(0);
            $table->integer('price');
            $table->text('synopsis')->nullable();
            $table->foreignId('updated_by')->constrained(
                table: 'users',
                indexName: 'books_user_id_index'
            );
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
