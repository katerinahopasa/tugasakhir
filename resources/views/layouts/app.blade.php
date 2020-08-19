<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ketenger Adventure</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Tell the browser to be responsive to screen width -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <!-- Tempusdominus Bbootstrap 4 -->
      <link rel="stylesheet" href="{{asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
      <!-- iCheck -->
      <link rel="stylesheet" href="{{asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
      <!-- JQVMap -->
      <link rel="stylesheet" href="{{asset('assets/plugins/jqvmap/jqvmap.min.css')}}">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
      <!-- overlayScrollbars -->
      <link rel="stylesheet" href="{{asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
      <!-- Daterange picker -->
      <link rel="stylesheet" href="{{asset('assets/plugins/daterangepicker/daterangepicker.css')}}">
      <!-- summernote -->
      <link rel="stylesheet" href="{{asset('assets/plugins/summernote/summernote-bs4.css')}}">
      <!-- Google Font: Source Sans Pro -->
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


      <!-- Font Awesome Icons -->
      <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">

      <link rel="stylesheet" href="{{asset('assets/dist/air-datepicker/dist/css/datepicker.css')}}">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
      <!-- Google Font: Source Sans Pro -->
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
      @yield('header')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div id="wrapper">
              <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item d-none d-sm-inline-block">
                      @role('Admin')
                      <a href="{{ url('/admin') }}" class="nav-link">Halaman Utama Admin</a>
                      @endrole

                      @role('Manajer')
                      <a href="{{ url('/benharian') }}" class="nav-link">Halaman Utama Manajer</a>
                      @endrole

                      @role('benharian')
                      <a href="{{ url('/benharian') }}" class="nav-link">Halaman Utama Bendahara Wisata Harian</a>
                      @endrole

                      @role('benadventure')
                      <a href="{{ url('/benadventure') }}" class="nav-link">Halaman Utama Bendahara Adventure</a>
                      @endrole
                      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                          <span class="navbar-toggler-icon"></span>
                      </button>
                    </li>
                  </ul>
    
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto"></ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                      @unlessrole('Admin')
                      <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-hashpopup="true" aria-expanded="false">
                          <i class="fa fa-globe"></i>History<span class="badge badge-danger" id="count-notification"></span><span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                          @forelse($notifikasi as $notif)
                                @if($notif->tipe=='pemasukan' || $notif->tipe=='pengeluaran')
                                  @role('benharian|Manajer')
                                    <a class="dropdown-item" href="{{ url('/transaksi') }}">
                                         <span class="text-success">{{$notif->name}} </span> {{$notif->pesan}} {{$notif->tipe}} pada tanggal {{ date('d M y', strtotime($notif->created_at)) }}
                                      </a>
                                  @endrole
                                  @elseif($notif->tipe=='jurnal')
                                      @role('benadventure')
                                        <a class="dropdown-item" href="{{ url('/jurnal') }}">
                                             <span class="text-success">{{$notif->name}} </span> {{$notif->pesan}} {{$notif->tipe}} pada tanggal {{ date('d M y', strtotime($notif->created_at)) }}
                                          </a>
                                      @endrole
                                      @role('Manajer')
                                        <a class="dropdown-item" href="#">
                                             <span class="text-success">{{$notif->name}} </span> {{$notif->pesan}} {{$notif->tipe}} pada tanggal {{ date('d M y', strtotime($notif->created_at)) }}
                                          </a>
                                      @endrole
                                  @elseif($notif->tipe=='laporan Kegiatan')
                                      @role('benadventure|Manajer')
                                      <a class="dropdown-item" href="{{ url('/laporan-kegiatan') }}">
                                         <span class="text-success">{{$notif->name}} </span> {{$notif->pesan}} {{$notif->tipe}} pada tanggal {{ date('d M y', strtotime($notif->created_at)) }}
                                      </a>
                                      @endrole
                                  @elseif($notif->tipe=='realisasi kegiatan')
                                      @role('benadventure|Manajer')
                                      <a class="dropdown-item" href="{{ url('/laporan-kegiatan/realisasi/'.$notif->id_tambahan) }}">
                                         <span class="text-success">{{$notif->name}} </span> {{$notif->pesan}} {{$notif->tipe}} pada tanggal {{ date('d M y', strtotime($notif->created_at)) }}
                                      </a>
                                      @endrole
                                  @else
                                @endif
                             

                          @empty
                          <a class="dropdown-item" href="#">
                            No History
                          </a>
                          @endforelse
                        </div>
                        
                      </li>
                      @endunlessrole

                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <!-- <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li> -->
                        @else<!-- 
                            @role('Admin')
                              <li><a class="nav-link" href="{{ route('users.index') }}">Manage Users</a></li>
                              <li><a class="nav-link" href="{{ route('roles.index') }}">Manage Role</a></li>
                            @endrole -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>


                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>
            @yield('content')
            <div id='app'></div>
        </div>
        
        <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    
    <!-- ChartJS -->
    <script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{asset('assets/plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('assets/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/dist/js/adminlte.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
    
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('assets/dist/js/demo.js')}}"></script>
    
    <script src="{{asset('assets/js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

    <script src="{{asset('assets/dist/air-datepicker/dist/js/datepicker.js')}}"></script>
    <script src="{{asset('assets/dist/air-datepicker/dist/js/i18n/datepicker.en.js')}}"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

    
  @yield('script')

  <script>

    $('#datepicker').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
    }).datepicker("setDate", new Date());

    $('.datepicker2').datepicker({
        autoclose: true,
        format: 'yyyy/mm/dd',
    });

</script>

</body>

</html>