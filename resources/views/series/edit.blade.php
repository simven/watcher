@extends('base.master')

@section('title', 'Insertion de l\'avis de rédaction')

@section('content')

<form action="{{route('series.update',$serie->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="text-center" style="margin-top: 2rem">
        <h3>Modification d'une série</h3>
        <hr class="mt-2 mb-2">
    </div>
    <div>
        <label for="nom"><strong> {{$serie->nom}}</strong></label>
    </div>
    <div>
        <label for="avis"><strong>Avis de la Rédaction : </strong></label>
        <input type="text" name="avis" id="avis"
               value="{{ $serie->avis }}">
    </div>
    <div>
        <label for="urlAvis"><strong>Vidéo la Rédaction : </strong></label>
        <input type="text" name="urlAvis" id="urlAvis"
               value="{{ $serie->urlAvis }}">
    </div>
    <div>
        <button class="btn btn-success" type="submit">Valide</button>
    </div>
</form>
@endsection