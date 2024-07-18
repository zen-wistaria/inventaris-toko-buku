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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name', 100);
            $table->string('code', 100)->Unique('transactions_code_unique');
            $table->integer('total_price');
            $table->string('status', 1)->default('1');
            $table->foreignId('updatedBy')->constrained(
                table: 'users',
                indexName: 'transactions_user_id_index'
            );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
