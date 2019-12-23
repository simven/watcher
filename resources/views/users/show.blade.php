@extends('base.master')

@section('title', 'Affichage de l\'utilisateur')

@section('content')
    @if($user->avatar)
        <img src="{{url($user->avatar)}}">
    @endif
    <p> {{$user->name}}</p>
    @if($user->administrateur==1)
        <p> Statut : Administrateur </p>
    @else
        <p> Statut : Utilisateur </p>
    @endif

    <p> Épisodes visionnés : {{$nbEpisodesVus}}</p>
    <p> Heures visionnées : {{$nbHeuresVues}}</p>
    <p> Avis postés : {{$nbAvisPostes}}</p>
    <button type="button">
        <a href="{{route('users.edit',$user->id)}}"> Modifier le profil </a>
    </button>
    <br><br>
    <button type="button">
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Se déconnecter </a>
    </button>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    <h2>Séries visionnées</h2>
    <ul>
        @foreach($seriesVisionnees as $serieVisionnee)
            <li> {{$serieVisionnee->nom}}</li>
        @endforeach

    </ul>
    <h2>Commentaires postés</h2>
    <hr>
    @foreach($commentairesUser as $commentaire)
        @foreach($seriesCommentees as $serie)
            @if($serie->id == $commentaire->serie_id)
                <p> IdCommentaire : {{$commentaire->id}} Note : {{$commentaire->note}} Série : {{$serie->nom}}</p>
                <p> Commentaire : {{$commentaire->content}} </p>
                <p> Créé le : {{$commentaire->created_at}}</p>
                <hr>
            @endif
        @endforeach
    @endforeach
@endsection
