@extends('base.master')

@section('title', 'Liste des séries')

@section('content')

    <h1>La liste des séries</h1>
        @if(!empty($series))
            <h3>Filtrage par genre</h3>
            <form action=""{{route('series.index')}} method="get">
                <select name="gre">
                    <option value=-1 @if($idGre == -1) selected @endif> Tous genres</option>
                    @foreach($genres as $genre)
                        <option value="{{$genre->id}}" @if($idGre == $genre->id) selected @endif>{{$genre->nom}}</option>
                    @endforeach
                </select>
                <input type="submit" class="btn btn-dark" value="OK">
            </form>
            <div class="liste-serie">
            @foreach($series as $serie)
            <ul>
                <li>
                    <a href="{{route('series.show',$serie->id)}}"><img src="{{url($serie->urlImage)}}"></a>

                    <ul>
                        <li>
                            <p> <a href="{{route('series.show',$serie->id)}}">  {{$serie->nom}}</a> </p>
                        </li>
                        <li>
                            Note : {{$serie->note}}
                        </li>
                    </ul>
                </li>
                <br>
            </ul>
            @endforeach
        @else
            <h2>Aucune série</h2>
        @endif
@endsection
