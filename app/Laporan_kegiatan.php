<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan_kegiatan extends Model
{
    protected $table = 'laporan_kegiatan';
    protected $fillable = ['nama_pelanggan','nama_kegiatan','tgl_kegiatan','status'];

    public function pendapatan_kegiatan(){
   		return $this->hasMany('App\Pendapatan_kegiatan');
   	}

   	public function pengeluaran_kegiatan(){
   		return $this->hasMany('App\Pengeluaran_kegiatan');
   	}

    public function realisasi_kegiatan(){
      return $this->hasMany('App\Realisasi_kegiatan','id_laporankegiatan');
    }

   	// Non-aktifkan Timestamp
    public $timestamps = false;
}
