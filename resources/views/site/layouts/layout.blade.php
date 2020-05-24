<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Online School</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/open-iconic-master/font/css/open-iconic-bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <style>
        body {
            position: relative;
            min-height: 100%;
            margin: 0;
            background-image: url({{ asset('img/Background_fone.png') }});
            background-attachment: fixed;
            background-size: cover;
        }
    </style>

</head>

<body>

<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/jquery-3.4.1.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('components/fontawesome-5.7.2/js/all.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/player.js') }}" type="text/javascript"></script>



@section('header')

    <header>

        <div class="container-fluid">

            <div class="row">

                <div class="col-md-12 col-lg-12">

                    @include('site.components.header')

                </div>

            </div>

        </div>

    </header>

@show

<section>

    <div class="container-fluid">

        <div class="row">

            <main>

                <div class="col-md-12 col-lg-12">

                    @yield('content')

                </div>

            </main>

        </div>

    </div>

</section>

<footer>

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12 col-lg-12">

                @section('footer')

                    @include('site.components.footer')

                @show

            </div>

        </div>

    </div>

</footer>

</body>

</html>
