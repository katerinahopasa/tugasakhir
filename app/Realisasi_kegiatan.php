<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Realisasi_kegiatan extends Model
{
    protected $table = 'realisasi_kegiatan';
    
    protected $fillable = ['id_jenis','id_laporankegiatan','nominal','keterangan','tipe'];

    public function jenis_transaksikegiatan(){
   		return $this->belongsTo('App\Jenis_transaksikegiatan','id_jenis');
   	}

   	public function laporan_kegiatan(){
   		return $this->belongsTo('App\Laporan_kegiatan','id_laporankegiatan');
   	}

   	// Non-aktifkan Timestamp
    public $timestamps = false;
}
