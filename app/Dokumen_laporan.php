<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokumen_laporan extends Model
{
    protected $fillable = ['judul_dokumen','deskripsi','file'];
}
