<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis_transaksikegiatan extends Model
{
    protected $table = 'Jenis_transaksikegiatan';
    
    protected $fillable = ['nama_jenis','deskripsi'];

    public function realisasi_kegiatan(){
    	return $this->hasMany('App\Realisasi_kegiatan','id_jenis');
    }

    // Non-aktifkan Timestamp
    public $timestamps = false;
}
