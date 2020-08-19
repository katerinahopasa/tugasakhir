<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Masukan Pendapatan</h3>
    </div>

    <div class="panel-body">
        <div class="form-inline">
            <div class="input-group">
                Name
                <select wire:model="jenis" required title="Jenis Pendapatan" class="form-control">
                   <option value="">Pilih Pengeluaran</option>
                    @foreach($jpr as $kt)
                   <option value="{{$kt->id}}">{{$kt->nama_jenis}}</option>
                     @endforeach
                </select>
                <input wire:model="name" type="text" class="form-control input-sm">
            </div>
            <div class="input-group">
                Deskripsi
                <input wire:model="deskripsi" type="text" class="form-control input-sm">
            </div>
            <div class="input-group">
                Nominal
                <input wire:model="nominal" type="number" class="form-control input-sm">
            </div>
            <div class="input-group">
                <br>
                <button wire:click="store()" class="btn btn-default">Save</button>
            </div>
        </div>
    </div>
</div>