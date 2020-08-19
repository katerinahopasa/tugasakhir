<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pemasukanharian extends Model
{
    protected $table = 'pemasukanharian';
    protected $fillable = ['tanggal','jml_pengunjung','harga_tiket','total_pemasukan','keterangan','tipe'];

    // Non-aktifkan Timestamp
    public $timestamps = false;

    public function pengeluaranharian()
    { 
    	return $this->hasMany('App\Pengeluaranharian'); 
	}
}
