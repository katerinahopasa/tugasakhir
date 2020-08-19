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
          <td><h4><b>NERACA LAPORAN</b></h4></td>
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

  <br>

  <center>
    <h5>AKTIVA LANCAR</h5>
  </center>
   <table border="1" class="table table-hover table-bordered table-striped">
    <tr>
      <th class="text-center">No</th>
      <th class="text-center">Nama Akun</th>
      <th class="text-center">Nominal</th>
    </tr>
    <?php $i = 1 ?>
    <?php $jumlah_aktiva_lancar = 0 ?>
    @foreach($aktiva_lancar as $data)
      <tr>
        <td class="text-center">{{ $i++ }}</td>
        <td>{{$data['nama']}}</td>
        <td>Rp. {{ number_format($data['value'], 0, ',', '.') }},-</td>
      </tr>
      <?php $jumlah_aktiva_lancar += $data['value'] ?>
    @endforeach
    <tr>
      <th colspan="2" class="text-center">Jumlah Aktiva Lancar</th>
      <th>Rp. {{ number_format($jumlah_aktiva_lancar, 0, ',', '.') }},-</th>
    </tr>
  </table>

  <center>
    <h5>AKTIVA TETAP</h5>
  </center>
  <table class="table table-hover table-bordered table-striped">
    <tr>
      <th class="text-center">No</th>
      <th class="text-center">Nama Akun</th>
      <th class="text-center">Debit</th>
      <th class="text-center">Kredit</th>
    </tr>
  <?php $i = 1 ?>
  @foreach($aktiva_tetap as $data)
    <tr>
      <td class="text-center">{{ $i++ }}</td>
      <td>{{$data->nama_akun}}</td>
      <td>@if($data->tipe == 'd')
          Rp. {{ number_format($data->nominal, 0, ',', '.') }},-
          @else
          -
          @endif

      </td>
      <td>@if($data->tipe == 'k')
          Rp. {{ number_format($data->nominal, 0, ',', '.') }},-
          @else
          -
          @endif</td>
    </tr>
  @endforeach

  <?php $jumlah_aktivatetap = 0 ?>
  @foreach($jumlah_aktiva_tetap as $data)
      <?php $jumlah_aktivatetap += $data['value'] ?>
  @endforeach

  <tr>
    <th colspan="2" class="text-center">Jumlah Aktiva Tetap</th>
    <th colspan="2" class="text-center">Rp. {{ number_format($jumlah_aktivatetap, 0, ',', '.') }},-</th>
  </tr>
  <tr>
    <th colspan="2" class="text-center">JUMLAH SELURUH AKTIVA</th>
    <?php $jumlah_seluruh_aktiva = $jumlah_aktiva_lancar + $jumlah_aktivatetap?>
    <th colspan="2" class="text-center"><b><i>Rp. {{ number_format($jumlah_seluruh_aktiva, 0, ',', '.') }},-</i></b></th>
  </tr>
</table>

  <center>
    <h5>PASIVA </h5>
  </center>
   <table class="table table-hover table-bordered table-striped">
    <tr>
      <th class="text-center">No</th>
      <th class="text-center">Nama Akun</th>
      <th class="text-center">Nominal</th>
    </tr>
  <?php $i = 1 ?>
  <?php $jumlah_pasiva = 0 ?>
  @foreach($pasiva as $data)
    <tr>
      <td class="text-center">{{ $i++ }}</td>
      <td>{{$data['nama']}}</td>
      <td>Rp. {{ number_format($data['value'], 0, ',', '.') }},-</td>
    </tr>
    <?php $jumlah_pasiva += $data['value'] ?>
  @endforeach

  <tr>
    <th colspan="2" class="text-center">Jumlah Pasiva</th>
    <th>Rp. {{ number_format($jumlah_pasiva, 0, ',', '.') }},-</th>
  </tr>
</table>

<center>
    <h5>EKUITAS</h5>
  </center>
   <table class="table table-hover table-bordered table-striped">
    <tr>
      <th class="text-center">No</th>
      <th class="text-center">Nama Akun</th>
      <th class="text-center">Nominal</th>
    </tr>
  <?php $i = 1 ?>
  <?php $jumlah_ekuitas = 0 ?>
  @foreach($ekuitas as $data)
    <tr>
      <td class="text-center">{{ $i++ }}</td>
      <td>{{$data['nama']}}</td>
      <td>Rp. {{ number_format($data['value'], 0, ',', '.') }},-</td>
    </tr>
    <?php $jumlah_ekuitas += $data['value'] ?>
  @endforeach

  <tr>
    <th colspan="2" class="text-center">Jumlah Ekuitas</th>
    <th>Rp. {{ number_format($jumlah_ekuitas, 0, ',', '.') }},-</th>
  </tr>
  <tr>
    <th colspan="2" class="text-center">JUMLAH PASIVA DAN EKUITAS</th>
    <?php $jumlah_pasiva_ekuitas = $jumlah_pasiva + $jumlah_ekuitas ?>
    <th colspan="2"><b><i>Rp. {{ number_format($jumlah_pasiva_ekuitas, 0, ',', '.') }},-</i></b></th>
  </tr>
</table>

<center>
    <h5>LABA BERSIH</h5>
  </center>
   <table class="table table-hover table-bordered table-striped">
      <tr>
        <th colspan="2" class="text-center">Total Laba Bersih</th>
        <th class="text-center"><b><i>Rp. {{ number_format($laba_bersih, 0, ',', '.') }},-</i></b></th>
      </tr>
  </table>

</body>
</html>
