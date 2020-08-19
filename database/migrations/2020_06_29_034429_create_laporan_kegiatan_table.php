<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_kegiatan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_pelanggan');
            $table->string('nama_kegiatan');
            $table->date('tgl_kegiatan');
            $table->enum('status', ['m', 's','b']);
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
        Schema::dropIfExists('laporan_kegiatan');
    }
}
