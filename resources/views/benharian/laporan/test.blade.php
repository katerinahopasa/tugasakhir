@extends('layouts.app')

@section('content')

    <h2 class="ui header">Daftar Laporan</h2>

    <!-- step 1: placeholder -->
    <div id="spreadsheet"></div>

@endsection

@section('script')

    // step 2: include aset-aset jExcel
    <script src="https://bossanova.uk/jexcel/v3/jexcel.js"></script>
    <link rel="stylesheet" href="https://bossanova.uk/jexcel/v3/jexcel.css" type="text/css"/>
    <script src="https://bossanova.uk/jsuites/v2/jsuites.js"></script>
    <link rel="stylesheet" href="https://bossanova.uk/jsuites/v2/jsuites.css" type="text/css"/>

    <script>


      // step 3: ubah data dari Controller menjadi JSON
      var data = @json($items);

      // step 4: instansiasi jExcel dan definisikan kolom      
      $('#spreadsheet').jexcel({
        data: data,
        columns: [
          {type: 'text', title: 'Nama Pembagian', width: 200},
          {type: 'text', title: 'Persentase', width: 200},
          {type: 'numeric', title: 'Nominal', width: 300, mask: 'Rp#.##,00', decimal: ','},
        ]
      });
    </script>
@endsection