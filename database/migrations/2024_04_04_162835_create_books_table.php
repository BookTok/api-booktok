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
            $table->string('name');
            $table->unsignedBigInteger('id_author');
            $table->unsignedBigInteger('id_publisher');
            $table->string('description', 250);
            $table->bigInteger('pages');
            $table->enum('sales', ['AMAZ', 'CASA_LIBRO', 'FNAC', 'CORTE_INGLES']);
            $table->date('publication');
            $table->enum('genres', ['FIC', 'NO_FIC', 'POE', 'TEA', 'INF', 'OTROS']);
            $table->string('pic', 500)->nullable();
            $table->foreign('id_author', 'id_author_book')->references('id')->on('authors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_publisher', 'id_publisher_book')->references('id')->on('publishers')->onDelete('cascade')->onUpdate('cascade');
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
