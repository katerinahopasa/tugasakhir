<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis_pendapatan extends Model
{
   	protected $table = 'jenis_pendapatan';

    public function pengeluaran_kegiatan(){
    	return $this->hasMany('App\Pengeluaran_kegiatan','id_jenis');
    }
   	
}
