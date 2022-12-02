<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // fungsi untuk membuat tabel produk di database
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('namaProduk');
            $table->string('foto');
            $table->double('harga');
            $table->string('descProduk');
            $table->string('kondisi')->default('nonaktif');
            $table->foreignId('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produks');
    }
};
