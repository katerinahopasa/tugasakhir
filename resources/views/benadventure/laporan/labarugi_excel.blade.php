<!DOCTYPE html>
<html>
<head>
  <title>Laporan Keuangan</title>
  <style type="text/css">
    
  </style>
</head>
<body>

  <center>
    <table>
          <tr>
          <td colspan="1"></td>
          <td><h4><b>LAPORAN LABA RUGI</b></h4></td>
          </tr>
          <tr>
            <td colspan="1"></td>
            <td><b>PERIODE</b></td>
          </tr>
          <tr>
            <td colspan="1"></td>
            <td><b>{{ date('d M Y',strtotime($periode)) }}</b></td>
          </tr>
      </table>
  </center>

  <table>
    <tr>
      <td>PERIODE</td>
      <td>{{ date('d M Y',strtotime($periode)) }}</td>
   
    </tr>
  </table>

  <br>

  <center>
    <h5>PENDAPATAN</h5>
  </center>
   <table class="table table-hover table-bordered table-striped">
      <tr>
        <th class="text-center">No</th>
        <th class="text-center">Jenis Akun</th>
        <th class="text-center">Nama Akun</th>
        <th class="text-center">Nominal</th>
      </tr>
    <?php $i = 1 ?>
    @foreach($data_akunpendapatan as $data)
      <tr>
        <td class="text-center">{{ $i++ }}</td>
        <td>{{ $data->jenis_akun }}</td>
        <td>{{ $data->nama_akun }}</td>
        <td>Rp. {{ number_format($data->nominal, 0, ',', '.') }},-</td>
      </tr>
    @endforeach

    <tr>
      <th colspan="3" class="text-center">Total Pendapatan</th>
      <th>Rp. {{ number_format($total_pendapatan, 0, ',', '.') }},-</th>
    </tr>
  </table>

  <center>
    <h5>BEBAN - BEBAN</h5>
  </center>
  <table class="table table-hover table-bordered table-striped">
    <tr>
      <th class="text-center">No</th>
      <th class="text-center">Jenis Akun</th>
      <th class="text-center">Nama Akun</th>
      <th class="text-center">Nominal</th>
    </tr>
  <?php $i = 1 ?>
  @foreach($data_akunbeban as $data)
    <tr>
      <td class="text-center">{{ $i++ }}</td>
      <td>{{ $data->jenis_akun }}</td>
      <td>{{ $data->nama_akun }}</td>
      <td>Rp. {{ number_format($data->nominal, 0, ',', '.') }},-</td>
    </tr>
  @endforeach

  <tr>
    <th colspan="3" class="text-center">Total Beban</th>
    <th>Rp. {{ number_format($total_beban, 0, ',', '.') }},-</th>
  </tr>
  <tr>
    <th colspan="3" class="text-center">TOTAL LABA</th>
    <th><i>Rp. {{ number_format($laba_bersih, 0, ',', '.') }},-</i></th>
  </tr>
  <tr>
      <th colspan="2" class="text-center">Terbilang</th>
      <th colspan="3" class="text-center">
      <em>{{ ucwords(terbilang($laba_bersih)) }} Rupiah</em>
      </th>
  </tr>
  <tr>
</table>

</body>
</html>
