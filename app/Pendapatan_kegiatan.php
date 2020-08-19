<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendapatan_kegiatan extends Model
{
    protected $table = 'pendapatan_kegiatan';
    
    protected $fillable = ['id_jenis','nominal','deskripsi'];

    public function jenis_pendapatan(){
   		return $this->belongsTo('App\Jenis_pendapatan','id_jenis','id');
   	}

   	public function laporan_kegiatan(){
   		return $this->belongsTo('App\Laporan_kegiatan');
   	}

   	// Non-aktifkan Timestamp
    public $timestamps = false;
}
