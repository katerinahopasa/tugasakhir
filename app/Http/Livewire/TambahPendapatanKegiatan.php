<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Pendapatan_kegiatan;

class TambahPendapatanKegiatan extends Component
{
    public function render()
    {
        $this->data = Pendapatan_kegiatan::all();
        return view('livewire.tambah-pendapatan-kegiatan');
    }

    private function resetInput()
    {
        $this->nama_jenis = null;
        $this->nominal = null;
        $this->deskripsi = null;
    }

    public function store()
    {
        $this->validate([
            'nama_jenis' => 'required|min:5',
            'nominal' => 'required',
            'deskripsi' => 'required'
        ]);

        Contact::create([
            'nama_jenis' => $this->nama_jenis,
            'nominal' => $this->nominal,
            'deskripsi' => $this->deskripsi
        ]);

        $this->resetInput();
    }

    public function edit($id)
    {
        $record = Pendapatan_kegiatan::findOrFail($id);

        $this->selected_id = $id;
        $this->nama_jenis = $record->nama_jenis;
        $this->nominal = $record->nominal;
        $this->deskripsi = $record->deskripsi;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'nama_jenis' => 'required|min:5',
            'nominal' => 'required',
            'deskripsi' => 'required'
        ]);

        if ($this->selected_id) {
            $record = Pendapatan_kegiatan::find($this->selected_id);
            $record->update([
                'nama_jenis' => $this->nama_jenis,
                'nominal' => $this->nominal,
                'deskripsi' => $this->deskripsi
            ]);

            $this->resetInput();
            $this->updateMode = false;
        }

    }

    public function destroy($id)
    {
        if ($id) {
            $record = Pendapatan_kegiatan::where('id', $id);
            $record->delete();
        }
    }
}