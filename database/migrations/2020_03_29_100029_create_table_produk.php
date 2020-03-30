<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_produk', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier')->unsigned();
            $table->string('nama',255);
            $table->string('kode',40);
            $table->integer('stock');
            $table->integer('minimal_stock');
            $table->integer('harga');
            $table->timestamps();

            $table->foreign('supplier')->references('id')->on('m_supplier')->onDelete('restrict');
            $table->engine="innoDB";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_produk', function (Blueprint $table) {
            //
        });
    }
}
