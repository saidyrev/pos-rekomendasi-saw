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
        Schema::create('promos', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_produk1');
            $table->unsignedInteger('id_produk2');
            $table->foreign('id_produk1')->on('produk')->onDelete('cascade')->onUpdate('cascade')->references('id_produk');
            $table->foreign('id_produk2')->on('produk')->onDelete('cascade')->onUpdate('cascade')->references('id_produk');
            $table->string("nama_promo");
            $table->string("status");
            $table->integer("diskon");
            $table->integer("harga");
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
        Schema::dropIfExists('promos');
    }
};
