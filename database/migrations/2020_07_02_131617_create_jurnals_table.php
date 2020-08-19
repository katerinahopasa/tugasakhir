<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurnalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('keterangan', 255);
            $table->enum('jenis_jurnal', ['u', 'p']);
            $table->date('waktu_transaksi');
            $table->integer('nominal')->unsigned();
            $table->enum('tipe', ['d', 'k']);
            $table->integer('id_akun')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jurnals');
    }
}
