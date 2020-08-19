<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RealisasiKegiatanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id_laporankegiatan' => 'required|max:10',
            'id_jenis' => 'required|max:10',
            'nominal' => 'required|integer',
            'keterangan' => 'required|string|max:255',
            'tipe' => 'required|in:m,k',
        ];
    }
}