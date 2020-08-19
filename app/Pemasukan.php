<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    protected $table = 'pemasukan';

    protected $fillable = ['id','tanggal','jml_pengunjung','harga_tiket','total_pemasukan'];

    //public function pengeluaran()
    //{ 
      //  return $this->hasMany('App\Pengeluaran'); 
    //}

    // Non-aktifkan Timestamp
    public $timestamps = false;

    
}
