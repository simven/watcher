@extends('base.master')

@section('title', 'Affichage des séries')

@section('content')
    <div class="banniere">
        <img src="{{  url('banniere/'.$serie->id.'.jpg') }}">
    </div>
    <div class="infos">
        <h1>{{$serie->nom}}</h1>
        <p> {!!$serie->resume !!} </p>
        <div id="genre"></div>
        @if(Auth::user()!= null)
            <div>
                <a href="series.vuSerie">
                    <input type="checkbox" id="Vu" name="Vu" unchecked>
                </a> Vu
            </div>
        @endif

        <div class="stats">
            <!-- ON AURAIT BESOIN DE CSS ET TOUT ET OUT-->
            <h3>Quelques stats</h3>
            @if($nbAvis!=null)
                <p> <span>{{$nbAvis}}</span> commentaires </p>
            @endif
            @if($moyenne!=null)
                <p> <span>{{round($moyenne,2)}}</span> de note moyenne</p>
            @endif
            <p> <span>{{$dureeSerie/60}}</span> heures</p>
            <p> <span>{{$nbEpisodes}}</span> épisodes</p>
        </div>
        <div class="genres">
            @if(isset($genres[0]))

                <ul style="margin-top : 50px;">
                    @foreach($genres as $genre)
                        <li>{{$genre->nom}}</li>
                    @endforeach
                </ul>
            @else
                <p>Aucun genre</p>
            @endif
        </div>
    </div>
    <div class="avisetsaisons">
        <div class="avis">
            <div>
                @if($serie->avis != null)
                    <h2>Avis de la rédaction : {!!$serie->avis !!} </h2>
                @else
                    <h2> La rédaction commentera bientôt cette série. </h2>
                @endif
                <div>
                    @if($serie->urlAvis != null)
                        <h2>Vidéo de la rédaction : {!!$serie->urlAvis !!} </h2>
                    @endif
                </div>
            </div>
        @if(isset($comments[0]))
            <h2>Commentaires :</h2>
                <br/>
                <div class="trier">
                    Ordre des notes :
                </div>
            <form action="{{route('series.show',$serie->id)}}" method="get" id="form_tri">
                <select name="filtreCom" id="liste_comm">
                    <option value="none" @if($filtreCom=='none') selected @endif> Aucun tri </option>
                    <option value="croissant" @if($filtreCom=='coissant') selected @endif> Croissant </option>
                    <option value="decroissant" @if($filtreCom=='decroissant') selected @endif> Décroissant </option>
                </select>
                <input type="submit" value="OK" id="btn_comm">
            </form>
                <ul>
                    @foreach($comments as $comment)
                        @if(Auth::user() && Auth::user()->administrateur == 1)
                            <div class="commentaire">
                                <li><p>Commentaire : {{$comment->content}}</p> </li>
                                <p>Note : {{$comment->note}} Commenté le : {{$comment->created_at}}</p>
                                <button type="button"> Valider </button>
                            </div>
                        @else
                            @if($comment->validated==1)
                                <div class="commentaire">
                                    <li><p>Commentaire  : {{$comment->content}} </p></li>
                                    <p> Note : {{$comment->note}} Commenté le : {{$comment->created_at}}</p>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </ul>
            @else
                <p>Aucun commentaire</p>
            @endif
        </div>
    </div>
    @if(Auth::user()!= null)
        <br>
                <form action="{{route('comments.store')}}" method="POST">
                    {!! csrf_field() !!}
                    <input type="hidden" name="id" value="{{$serie->id}}" />
                    <div class="text-center" style="margin-top: 2rem">
                        <h3>Nouveau commentaire</h3>
                        <hr class="mt-2 mb-2">
                    </div>
                    <div>
                        <label for="titre"><strong>Note : </strong></label>
                        <input type="text" name="note" id="note"
                               value="{{ old('note') }}"
                               placeholder="5">
                    </div>
                    <div>
                        <label for="textarea-input"><strong>Commentaire :</strong></label>
                        <textarea name="content" id="content" rows="6" class="form-control"
                                  placeholder="commentaire...">{{ old('content') }}</textarea>
                    </div>
                    <div>
                        <button class="btn btn-success" type="submit">Valider</button>
                    </div>
                </form>
        @endif
        <div class="espacesaison">
            <h2>Episodes :</h2><br/>
            <div id="buttonSaison">
                @foreach($saisons as $saison)
                    <button onclick="opena(event, 'saison{{$saison}}')"> Saison {{$saison}}</button>
                @endforeach
            </div>
            <div id="saisons">
                @foreach($saisons as $saison)
                    <div id="saison{{$saison}}" class="initFerme">
                        @foreach($episodes as $episode)
                            @if($episode->saison == $saison)
                                <div class="voirepisode">
                                    <p>
                                        @if ($episode->urlImage)
                                            <img src="{{url($episode->urlImage)}}">
                                        @endif
                                        <strong><br/>{{$episode->nom}}<br/></strong>
                                            <a href="{{route('episodes.show',$episode->id)}}"> Voir </a>
                                    </p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    @if(Auth::user() && Auth::user()->administrateur == 1)
        <div class="creerAvisRedac">
            <button type="button">
                <a href="{{route('series.edit',$serie->id)}}"> Mettre en ligne un avis </a>
            </button>
            <br>
        </div>
    @endif
    @if($action == 'delete')
        <form action="{{route('series.destroy',$serie->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <div class="text-center">
                <button type="submit" name="delete" value="valide">Valide</button>
                <button type="submit" name="delete" value="annule">Annule</button>
            </div>
        </form>
    @endif
    <div>
        <button type="button">
            <a href="{{route('series.index')}}">Retour à la liste</a>
        </button>

    </div>
@endsection
