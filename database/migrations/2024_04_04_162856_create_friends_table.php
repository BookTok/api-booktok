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
        Schema::create('friends', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_friend');
            $table->timestamps();
            $table->foreign('id_user', 'id_user_friend')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_friend', 'id_friends')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->unique(['id_user', 'id_friend']);
            $table->foreign('id_user')->references('id')->on('users')->whereColumn('user_id', '!=', 'friend_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('friends');
    }
};
