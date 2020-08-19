<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PemasukanharianRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tanggal' => 'required|date',,
            'jml_pengunjung' => 'required|integer',
            'harga_tiket' => 'required|integer',
            'total_pemasukan' => 'required|integer',
            'tipe' => 'required|in:d,k',
            'keterangan' => 'required|max:255',
        ];
    }
}
