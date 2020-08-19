<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pengeluaranharian extends Model
{
    protected $table = 'pengeluaranharian';
    protected $fillable = ['tanggal','nama_pengeluaran','nominal','keterangan','bukti_pembayaran','tipe','pemasukanharian_id'];
    protected $primaryKey = 'pemasukanharian_id';

    // Non-aktifkan Timestamp
    public $timestamps = false;

    public function pemasukanharian()
    {
    	return $this->belongsTo('App\Pemasukanharian','pemasukanharian_id');
    }
}
