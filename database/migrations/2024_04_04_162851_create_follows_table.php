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
        Schema::create('follows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_author')->nullable();
            $table->unsignedBigInteger('id_publisher')->nullable();
            $table->foreign('id_user', 'id_user_follow')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_author', 'id_author_follow')->references('id')->on('authors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_publisher', 'id_publisher_follow')->references('id')->on('publishers')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follows');
    }
};
