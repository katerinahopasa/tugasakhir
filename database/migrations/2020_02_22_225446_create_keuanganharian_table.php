<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeuanganharianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keuanganharian', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('tanggal');
            $table->bigInteger('pemasukan_harian');
            $table->bigInteger('pengeluaran_harian');
            $table->bigInteger('saldo');
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
        Schema::dropIfExists('keuanganharian');
    }
}
