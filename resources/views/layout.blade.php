<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $Ruta }}</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script defer src="{{ asset('js/nav-selected.js')}}"></script>
    <script src="{{ asset('js/alertes.js')}}"></script>
    <script src="{{ asset('js/right-sidebar.js')}}"></script>
    <script defer src="{{ asset('js/qr.js')}}"></script>
    <script defer src="{{ asset('js/search-size.js')}}"></script>
    <script defer src="{{ asset('js/accessible.js')}}"></script>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/app.css')}}">
</head>
<body>
   @include('partials._message')
    <div class="container_home">
        <div class="grid_nav">
            @include('partials._header')
        </div>

        <div class="grid_aside_left">
            @if ($Ruta != 'login' && $Ruta != 'registre') 
                @include('partials._lsidebar')
            @endif
        </div>

        <div class="grid_main">
            @yield('content')
        </div>

        <div class="grid_aside_right">
            @if (str_contains(strtolower($Ruta), 'articles_form'))
                @include('partials._rsidebar-opcions')
            @else
                @include('partials._rsidebar-fitxa')
            @endif
        </div>

        <div class="grid_footer">
           @include('partials._footer')
        </div>
    </div>

</body>
</body>
</html>
