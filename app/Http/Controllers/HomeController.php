<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $series = Serie::all();
        $trieSeriesNote = Serie::where('note', '!=', null)->orderBy('note', 'desc')->take(5)->get();
        //$episodesLesPlusVus = Serie::rightJoin('episodes','episodes.serie_id','=','series.id')->rightJoin('seen','seen.episode_id','=','episodes.id')->groupBy('series.id')->take(4)->get();

        return view('home', ['series' => $series, 'triSeriesNote' => $trieSeriesNote]);
    }
}
