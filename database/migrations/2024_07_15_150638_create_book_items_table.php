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
        Schema::create('book_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained(
                table: 'books',
                indexName: 'book_items_book_id_index'
            );
            $table->integer('total_books');
            $table->date('date');
            $table->foreignId('updated_by')->constrained(
                table: 'users',
                indexName: 'book_items_user_id_index'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_items');
    }
};
