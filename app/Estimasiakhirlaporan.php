<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estimasiakhirlaporan extends Model
{
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'nama_pembagian', 'persentase','nominal'
    ];
}
