<header>
    <a href="{{route('accueil')}}">
        <div class="logo">
        </div>
    </a>
    <div class="navigation">
        <a>
            <form action = "#" method = "get" id="form">
                <input type = "hidden" name="action" value="recherche">
                <input type = "search" name = "recherche" id="recherche">
                <input type = "submit" name = "go" value = "Rechercher" id="btn_recherche">
            </form>
        </a>
    </div>
    <div class="liens">
        <a href="{{ route('accueil') }}">ACCUEIL</a>
        <a href="{{ route('series.index') }}">SERIES</a>
        @if(Auth::user())
            <a href="{{ route('users.show',Auth::user()->id) }}">MON COMPTE</a>
        @else
            <a href="{{ route('login') }}">SE CONNECTER</a>
            <a href="{{ route('register') }}">S'INSCRICRE</a>
        @endif
    </div>
</header>
