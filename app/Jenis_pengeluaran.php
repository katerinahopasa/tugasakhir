<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis_pengeluaran extends Model
{
    protected $table = 'jenis_pengeluaran';

    public function pendapatan_kegiatan(){
    	return $this->hasMany('App\Pendapatan_kegiatan','id_jenis');
    }
}
