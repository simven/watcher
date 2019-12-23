@extends('base.master')

@section('title', 'Affichage de l\'épisode')

@section('content')
    <div class="bandeau">
        <div class="imageepisode">
            <img src="{{url($episode->urlImage)}}">
        </div>
        <div class="nomepisode">
            <p><h1>{{$episode->nom}} </h1></p>
        </div>
    </div>

        <div>
            <a href="{{'series.vuEpisode', $episode->id}}">
                <input type="checkbox" id="Vu" name="Vu" unchecked> Vu
            </a>
        </div>
        <div class="resume">
            <div class="resumeP">
                <h3><strong>Résumé : </strong></h3>
                <p>{!!$episode->resume !!}</p>
            </div>
            <div>
                <p><strong>Durée : </strong>{!!$episode->duree !!} minutes</p>
            </div>
            <div>
                <p><strong>Première diffusion : </strong>{!!$episode->premiere !!} </p>
            </div>
        </div>
    @if($episode->numero == 1 && $episode->saison == 1)
        <div>
            <button type="button">
                <a href="{{route('episodes.show',$episode->id+1)}}">épisode suivant</a>
            </button>
        </div>
    @else
        <div>
            <button type="button">
                <a href="{{route('episodes.show',$episode->id-1)}}">épisode précédent</a>
            </button>
            <button type="button">
                <a href="{{route('episodes.show',$episode->id+1)}}"> épisode suivant </a>
            </button>
        </div>
    @endif
    <br>
    <button type="button">
        <a href="{{route('series.show',$episode->serie_id)}}"> Retour à la série </a>
    </button>
@endsection
