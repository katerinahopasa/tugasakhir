<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Ketenger Adventure</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        @role('Admin')
                        <a href="{{ url('/admin') }}">Home</a>
                        @endrole
                        @role('Manajer')
                        <a href="{{ url('/benharian') }}">Home</a>
                        @endrole
                        @role('benharian')
                        <a href="{{ url('/benharian') }}">Home</a>
                        @endrole
                        @role('benadventure')
                        <a href="{{ url('/benadventure') }}">Home</a>
                        @endrole
                    @else
                        <a href="{{ route('login') }}">Login</a>
<!-- 
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif -->
                    @endauth
                </div>
            @endif

            <div class="content">
                    <img alt="logo Ketenger Adventure" src="{{asset('assets/dist/img/ketenger.png')}}" />
                    <center><h1 class="panel-title"><strong><font size="5">SISTEM INFORMASI PENGELOLAAN DAN PELAPORAN KEUANGAN KETENGER ADVENTURE</font></strong></h1>
                    <center><h6>by. 16102018</h6></center>
            </div>
        </div>
    </body>
</html>
