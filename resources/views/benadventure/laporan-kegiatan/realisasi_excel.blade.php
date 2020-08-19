<!DOCTYPE html>
<html>
<head>
  <title>Laporan Realisasi Keuangan Kegiatan</title>
</head>
<body>

  <center>
    <h4>REALISASI KEUANGAN KEGIATAN</h4>
  </center>

  <table>
    <tr>
      <td>Nama Pelanggan</td>
      <td>:</td>
      <td></td>
    </tr>
    <tr>
      <td>Nama Kegiatan</td>
      <td>:</td>
      <td></td>
    </tr>
  </table>

  <br>

  <table>
    <thead>
      <tr>
        <th scope="col"><b>No</b></th>
        <th scope="col"><b>Jenis Transaksi</b></th>
        <th scope="col"><b>Keterangan</b></th>
        <th scope="col"><b>Uang Masuk</b></th>
        <th scope="col"><b>Uang Keluar</b></th>
      </tr>
    </thead>
    <tbody>
      @foreach($data_kegiatan as $key => $p)
      <tr>
        <td>{{ ++$key }}</td>
        <td>{{ $p->jenis_transaksikegiatan->nama_jenis }}</td>
        <td>{{ $p->keterangan }}</td>
        <td>
        @if($p->tipe === 'm')
          Rp. {{ number_format($p->nominal, 0, ',', '.') }},-
        @else
          -
        @endif
        </td>
        <td>
        @if($p->tipe === 'k')
          Rp. {{ number_format($p->nominal, 0, ',', '.') }},-
        @else
          -
        @endif
        </td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td colspan="4"><b>Total Pemasukan</b></td>
        <td><b><i>{{ $total_pemasukan }}</i></b></td>
      </tr>
    </tfoot>
  </table>

  <center>
    <h5>DATA TRANSAKSI PENGELUARAN</h5>
  </center>
  <table>
    <thead>
      <tr>
        <th scope="col"><b>No</b></th>
        <th scope="col"><b>Tanggal</b></th>
        <th scope="col"><b>Nama Pengeluaran</b></th>
        <th scope="col"><b>Keterangan</b></th>
        <th scope="col"><b>Nominal Pengeluaran</b></th>
      </tr>
    </thead>
    <tbody>
      @foreach($pengeluaran as $key => $pl)
      <tr>
        <td>{{ ++$key }}</td>
        <td>{{ date('d-m-Y', strtotime($pl->tanggal )) }}</td>
        <td>{{ $pl->nama_pengeluaran }}</td>
        <td>{{ $p->keterangan }}</td>
        <td>{{ $pl->nominal }}</td>
      </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td colspan="4"><b>Total Pengeluaran</b></td>
        <td><b><i>{{$total_pengeluaran}}</i></b></td>
      </tr>
      <tr>
        <td colspan="4"><b>TOTAL PEMASUKAN BERSIH</b></td>
        <td><b><i>{{$total_pemasukan_bersih}}</i></b></td>
      </tr>
    </tfoot>
  </table>

</body>
</html>
