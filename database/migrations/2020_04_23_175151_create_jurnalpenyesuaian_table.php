<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurnalpenyesuaianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnalpenyesuaian', function (Blueprint $table) {
            $table->increments('id');
            $table->string('keterangan', 255);
            $table->date('waktu_transaksi');
            $table->integer('nominal')->unsigned();
            $table->enum('tipe', ['d', 'k']);
            $table->integer('id_akun')->unsigned();

            $table->foreign('id_akun')
            ->references('id')->on('akun')
            ->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jurnalpenyesuaian');
    }
}
