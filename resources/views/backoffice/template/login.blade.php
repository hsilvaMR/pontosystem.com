<!doctype html>
<html lang="pt-PT">

<head>
    @include('backoffice/includes/head')
    {{-- custom   css --}}
    <link rel="stylesheet" href="{{ asset('utilizador/style.css') }}">
    <link rel="icon" type="image/svg" href="{{ asset('img/site/favicon-v2.svg') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/site/favicon-v2.png">
    <title> {{ $headTitulo }}</title>
</head>

<body>
    @yield('content')

    {{-- library jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    {{-- custom scripts --}}
    <script type="text/javascript" src="{{ asset('backoffice/loginScript.js') }}"></script>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>

    {{-- Bootstrap  bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>


</body>

</html>
