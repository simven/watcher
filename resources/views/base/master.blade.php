<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @section('head')
        <meta charset="UTF-8">
    @show
    <title>{{ config('app.name','WATCH\'R') }} - @yield('title', 'Accueil')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
</head>
<body>
<!-- Menu -->
@include('base.navbar')
<br>

<div class="container">
    @yield('content','En Attente d\'un contenu')
</div>
<br>

@section('footer')
    <footer class="">

    </footer>
@show
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
