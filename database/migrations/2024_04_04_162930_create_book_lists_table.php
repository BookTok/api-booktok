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
        Schema::create('book_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_book');
            $table->unsignedBigInteger('id_list');
            $table->timestamps();
            $table->foreign('id_book', 'id_book_list')->references('id')->on('books')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_list', 'id_list')->references('id')->on('user_lists')->onDelete('cascade')->onUpdate('cascade');

            $table->unique(['id_book', 'id_list']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_lists');
    }
};
