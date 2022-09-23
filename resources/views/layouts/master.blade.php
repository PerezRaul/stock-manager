<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('build/assets/app.5380b351.css') }}" rel="stylesheet">

        <!-- Scripts -->
        <script type="text/javascript" src="{{ asset('build/assets/app.2c1604af.js') }}"></script>


    </head>
    <body class="antialiased">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-dark bg-dark">
                    <a class="navbar-brand" href="/">Stock Manager</a>
                </nav>
            </div>
        </div>
        @yield('content')
    </body>
</html>
