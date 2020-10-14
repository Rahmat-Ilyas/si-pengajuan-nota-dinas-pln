<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotadinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notadinas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pegawai_id')->unsigned();
            $table->string('nama_pasien');
            $table->string('status');
            $table->string('hub_keluarga');
            $table->string('no_nota')->default('');
            $table->string('tggl_nota')->default('');
            $table->string('perihal')->default('');
            $table->string('progres')->default('Dalam Proses');
            $table->string('foto_kuitansi');
            $table->timestamps();

            $table->foreign('pegawai_id')->references('id')->on('pegawais');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notadinas');
    }
}
