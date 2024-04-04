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
        Schema::create('book_status', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_book');
            $table->enum('status', ['READ', 'READING', 'WISH']);
            $table->timestamps();
            $table->foreign('id_user', 'id_user_status')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_book', 'id_book_status')->references('id')->on('books')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_status');
    }
};
