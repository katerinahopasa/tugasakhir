<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurnals extends Model
{
    // nama table tidak mengikuti konvensi laravel
    protected $table = 'jurnals';

    // Non-aktifkan Timestamp
    public $timestamps = false;

    // kolom tabel untuk Mass Assingment
    protected $fillable = ['keterangan', 'jenis_jurnal', 'waktu_transaksi', 'nominal', 'tipe', 'id_akun'];

    // kolom akan disembunyikan dalam array
    protected $hidden = [''];

    // Relasi N-1 antara akun dengan jurnal
    public function akun(){
        return $this->belongsTo('App\Akun', 'id_akun');
    }
}
