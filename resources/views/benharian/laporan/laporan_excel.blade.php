<!DOCTYPE html>
<html>
<head>
  <title>Laporan Keuangan</title>
</head>
<body>

  <center>
    <table>
          <tr>
          <td colspan="1"></td>
          <td><h4><b>LAPORAN KEUANGAN</b></h4></td>
          </tr>
          <tr>
            <td colspan="1"></td>
            <td>DARI TANGGAL :</td>
            <td>{{ date('d M Y',strtotime($mulai['mulai'])) }}</td>
          </tr>
          <tr>
            <td colspan="1"></td>
            <td>SAMPAI TANGGAL :</td>
            <td>{{ date('d M Y',strtotime($selesai['selesai'])) }}</td>
          </tr>
      </table>
  </center>

  <table>
    
  </table>

  <br>

  <center>
    <h5>DATA TRANSAKSI PEMASUKAN</h5>
  </center>
  <table>
    <thead>
      <tr>
        <th scope="col"><b>No</b></th>
        <th scope="col"><b>Tanggal</b></th>
        <th scope="col"><b>Jumlah Pengunjung</b></th>
        <th scope="col"><b>Keterangan</b></th>
        <th scope="col"><b>Nominal Pemasukan</b></th>
      </tr>
    </thead>
    <tbody>
      @foreach($pemasukan as $key => $p)
      <tr>
        <td>{{ ++$key }}</td>
        <td>{{ date('d M Y',strtotime($p->tanggal)) }}</td>
        <td>{{ $p->jml_pengunjung }}</td>
        <td>{{ $p->keterangan }}</td>
        <td>{{ $p->total_pemasukan }}</td>
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
        <td>{{ date('d M Y',strtotime($pl->tanggal)) }}</td>
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

  <center>
    <h5>ESTIMASI PEMBAGIAN PERSENTASE</h5>
  </center>
   <table class="table align-items-center table-flush">
     <thead>
        <tr>
          <th><b>No</b></th>
          <th><b>Nama Pembagian</b></th>
          <th><b>Persentase (%)</b></th>
          <th><b>Nominal</b></th>
        </tr>
     </thead>
        <tbody>
          <tr>
            <td>1.</td>
            <td>Upah Pengelola</td>
            <td>80%</td>
            <td><b><i>{{ 80/100*$total_pemasukan_bersih }}</i></b></td>
          </tr>
          <tr>
            <td>2.</td>
            <td>LMDH</td>
            <td>10%</td>
            <td><b><i>{{ 10/100*$total_pemasukan_bersih }}</i></b></td>
          </tr>
          <tr>
            <td>3.</td>
            <td>Sisa Hasil Usaha (SHU)</td>
            <td>10%</td>
            <td><b><i>{{ 10/100*$total_pemasukan_bersih }}</i></b></td>
          </tr>
        </tbody>
    </table>

</body>
</html>
