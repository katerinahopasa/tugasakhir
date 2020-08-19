<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran_kegiatan extends Model
{
    protected $table = 'pengeluaran_kegiatan';
    protected $fillable = ['id_jenis','nominal','deskripsi'];

    public function jenis_pengeluaran(){
   		return $this->belongsTo('App\Jenis_pengeluaran','id_jenis','id');
   	}

   	public function laporan_kegiatan(){
    	return $this->belongsTo('App\Laporan_kegiatan');
    }

    // Non-aktifkan Timestamp
    public $timestamps = false;
}
