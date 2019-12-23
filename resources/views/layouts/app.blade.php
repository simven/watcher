@extends('base.master')

@section('title', 'Affichage de l\'épisode')

@section('content')
<!-- Authentication Links -->
<nav>
    <ul>
        @guest
            <li><a href="{{ route('login') }}">Connexion</a></li>
            <li><a href="{{ route('register') }}">Inscription</a></li>
        @else
            <li> Bonjour {{ Auth::user()->name }}</li>
            @if (Auth::user())
                <?php redirect(route('home')); ?>
            @endif
            <li><a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    Logout
                </a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        @endguest
    </ul>
</nav>
<div id="main">
    @yield('content')
</div>
<!-- Scripts -->
<script src="{{ asset('js/jquery.js') }}"></script>
</div>
@endsection
