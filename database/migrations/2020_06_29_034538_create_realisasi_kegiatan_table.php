<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealisasiKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realisasi_kegiatan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('id_jenis')->unsigned();
            $table->BigInteger('id_laporankegiatan')->unsigned();
            $table->unsignedBigInteger('nominal');
            $table->text('keterangan');
            $table->enum('tipe', ['m', 'k']);

            $table->foreign('id_jenis')
            ->references('id')->on('jenis_transaksikegiatan')
            ->onDelete('cascade');

            $table->foreign('id_laporankegiatan')
            ->references('id')->on('laporan_kegiatan')
            ->onDelete('cascade');

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
        Schema::dropIfExists('realisasi_kegiatan');
    }
}
