<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Episode;
use App\Genre;
use App\User;
use App\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $idGre = $request->query('gre',-1);

        if($idGre > 0){
            $genre = Genre::find($idGre);
            $series = $genre->series;
        } else{
            $series = Serie::all();
        }

        $genres = Genre::all();


        return view('series.index',['series'=>$series, 'idGre' => $idGre, 'genres' => $genres]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('series.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => ['required', 'max:40'],
            'resume' => ['required', 'max:4'],
            'langue' => ['required', 'max:2'],
            'note' => ['required', 'max:5'],
            'statut' => ['required', 'max:30'],
            'premiere' => ['required','max:15'],
            'urlImage' => ['required','max:50'],
            'avis' => ['max:500'],
        ]);

        $input = $request->only(['nom','resume','langue','note','statut','premiere','urlImage']);

        $series = new Serie();

        $series->nom = $input['nom'];
        $series->resume = $input['resume'];
        $series->langue = $input['longue'];
        $series->note = $input['note'];
        $series->statut = $input['statut'];
        $series->premiere = $input['premiere'];
        $series->urlImage = $input['urlImage'];

        $series->save();

        return redirect('/series');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $saisons = Episode::where('serie_id',$id)->distinct('saison')->pluck('saison');

        $action=$request->query('action','show');
        $serie = Serie::find($id);
        $filtreCom = $request->query('filtreCom','none');
        if($filtreCom!='none') {
            if ($filtreCom == 'croissant')
                $comments = Comment::where('serie_id', $id)->orderBy('note', 'asc')->get();
            elseif ($filtreCom == 'decroissant')
                $comments = Comment::where('serie_id', $id)->orderBy('note', 'desc')->get();
        }
        else
            $comments = Comment::where('serie_id',$id)->get();

        $genres =  Genre::where('genre_serie.serie_id',$id)->join('genre_serie','genres.id','=','genre_serie.genre_id')->get();
        $episodes = Episode::where('serie_id',$id)->get();
        $nbAvis = Comment::where('comments.serie_id',$id)->where('comments.validated',1)->count();
        $sommeComValides = Comment::where('comments.serie_id',$id)->where('comments.validated',1)->sum('comments.note');
        if($nbAvis==0||$sommeComValides==0)
            $moyenne=0;
        else
            $moyenne = $sommeComValides/$nbAvis;
        $dureeSerie = Serie::find($id)->episodes()->sum('duree');
        $nbEpisodes = Serie::find($id)->episodes()->count();

        return view('series.show',[
            'serie'=>$serie,
            'action'=>$action,
            'comments'=>$comments,
            'genres'=>$genres,
            'episodes'=>$episodes,
            'saisons' => $saisons,
            'filtreCom'=>$filtreCom,
            'nbAvis'=>$nbAvis,
            'moyenne'=>$moyenne,
            'dureeSerie'=>$dureeSerie,
            'nbEpisodes'=>$nbEpisodes
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $serie = Serie::find($id);
        return view('series.edit',['serie'=>$serie]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nom' => ['max:40'],
            'resume' => ['max:4'],
            'langue' => ['max:2'],
            'note' => ['max:5'],
            'statut' => ['max:30'],
            'premiere' => ['max:15'],
            'urlImage' => ['max:50'],
            'avis' => ['required','max:500'],
            'urlAvis'=>['max:500']
        ]);

        $input = $request->only(['avis']);

        $serie = Serie::find($id);

        $serie->avis= $input['avis'];

        $serie->save();

        return redirect('/series/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->delete == 'valide') {
            $serie = Serie::find($id);
            $serie->delete();
        }
        return redirect()->route('series.index');
    }


    public function vuEpisode($id) {
        Auth::user()->seen()->attach($id);

        return back();
    }


    public function vuSerie($id) {
        Auth::user()->seen()->attach(Serie::find($id)->episodes()->pluck('id')->toArray());

        return back();
    }


    public function vuSaison($id, $num) {
        Auth::user()->seen()->attach(Serie::find($id)->episodes()->where('saison',$num)->pluck('id')->toArray());

        return back();
    }
}
