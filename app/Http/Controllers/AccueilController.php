<?php

namespace App\Http\Controllers;

use App\Episode;
use App\Serie;
use Illuminate\Http\Request;

class AccueilController extends Controller
{
    //
    public function index()
    {
        $series = Serie::all();
        $trieSeriesNote = Serie::where('note', '!=', null)->orderBy('note', 'desc')->take(5)->get();
        //$episodesLesPlusVus = Serie::rightJoin('episodes','episodes.serie_id','=','series.id')->rightJoin('seen','seen.episode_id','=','episodes.id')->groupBy('series.id')->take(4)->get();
        return view('home', ['series' => $series, 'triSeriesNote' => $trieSeriesNote]);
    }
}
