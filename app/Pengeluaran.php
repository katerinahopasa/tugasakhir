<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluaran';

    protected $fillable = ['id','tanggal','nama_pengeluaran','nominal'];

    //public function pemasukan()
    //{
    //	return $this->belongsTo('App\Pemasukan');
    //}

    // Non-aktifkan Timestamp
    public $timestamps = false;
}
