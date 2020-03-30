<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_supplier', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama',255);
            $table->text('alamat');
            $table->string('no_telp',20);
            $table->timestamps();

            $table->engine = 'innoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('m_supplier', function (Blueprint $table) {
            //
        });
    }
}
