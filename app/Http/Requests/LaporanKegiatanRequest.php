<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaporanKegiatanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'tgl_kegiatan' => 'required|date',
            'nama_pelanggan' => 'required|string|max:255',
            'nama_kegiatan' => 'required|string|max:255',
            'status' => 'required|in:m,s,b',
        ];
    }
}