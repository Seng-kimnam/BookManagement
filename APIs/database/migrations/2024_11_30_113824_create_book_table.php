<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->unsignedBigInteger('publisherid');
            $table->foreign('publisherid')->references('id')->on('publishers')->onDelete('cascade');

            $table->unsignedBigInteger('categoryid');
            $table->foreign('categoryid')->references('id')->on('categories')->onDelete('cascade');

            $table->string('published_year');
            $table->bigInteger('quantity');
            $table->float('price');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
