<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    // Nama table tidak ikuti Convention Laravel
    protected $table = 'akun';

    // kolom tabel untuk Mass Assingment
    protected $fillable = ['nama_akun', 'kode_akun', 'jenis_akun'];

    // relasi 1-N dengan Jurnal
    public function jurnal(){
        return $this->hasMany('App\Jurnal', 'id_akun');
    }

    // relasi 1-N dengan Jurnal Penyesuaian
    public function jurnalpenyesuaian(){
        return $this->hasMany('App\Jurnalpenyesuaian', 'id_akun');
    }

    // Non-aktifkan Timestamp
    public $timestamps = false;
}
