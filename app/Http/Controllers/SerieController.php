<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Serie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SerieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $idGre = $request->query('gre', -1);
        $series = $idGre > 0 ? Genre::findOrFail($idGre)->series : Serie::all();
        $genres = Genre::all();

        return view('series.index', [
            'series' => $series,
            'idGre' => $idGre,
            'genres' => $genres,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('series.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'nom' => ['required', 'max:40'],
            'resume' => ['required', 'max:255'],
            'langue' => ['required', 'max:10'],
            'note' => ['required', 'max:5'],
            'statut' => ['required', 'max:30'],
            'premiere' => ['required', 'max:15'],
            'urlImage' => ['required', 'max:255'],
            'avis' => ['nullable', 'max:500'],
        ]);

        $serie = Serie::create($validatedData);

        return redirect()->route('series.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, int $serie): View
    {
        $serie = Serie::findOrFail($serie);
        $saisons = $serie->episodes()->distinct()->pluck('saison');
        $filtreCom = $request->query('filtreCom', 'none');

        $action = $request->query('action','show');

        $comments = match ($filtreCom) {
            'croissant' => $serie->comments()->orderBy('note', 'asc')->get(),
            'decroissant' => $serie->comments()->orderBy('note', 'desc')->get(),
            default => $serie->comments,
        };

        $genres = $serie->genres;
        $episodes = $serie->episodes;
        $nbAvis = $serie->comments()->where('validated', 1)->count();
        $sommeComValides = $serie->comments()->where('validated', 1)->sum('note');
        $moyenne = $nbAvis > 0 ? $sommeComValides / $nbAvis : 0;
        $dureeSerie = $serie->episodes()->sum('duree');
        $nbEpisodes = $serie->episodes()->count();

        return view('series.show', compact(
            'serie',
            'saisons',
            'action',
            'comments',
            'genres',
            'episodes',
            'nbAvis',
            'moyenne',
            'dureeSerie',
            'nbEpisodes',
            'action',
            'filtreCom'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Serie $serie): View
    {
        return view('series.edit', compact('serie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Serie $serie): RedirectResponse
    {
        $validatedData = $request->validate([
            'nom' => ['max:40'],
            'resume' => ['max:255'],
            'langue' => ['max:10'],
            'note' => ['max:5'],
            'statut' => ['max:30'],
            'premiere' => ['max:15'],
            'urlImage' => ['max:255'],
            'avis' => ['required', 'max:500'],
            'urlAvis' => ['max:500'],
        ]);

        $serie->update($validatedData);

        return redirect()->route('series.show', $serie);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Serie $serie): RedirectResponse
    {
        $serie->delete();

        return redirect()->route('series.index');
    }

    public function vuEpisode(int $id): RedirectResponse
    {
        Auth::user()->seen()->attach($id);
        return back();
    }

    public function vuSerie(int $id): RedirectResponse
    {
        $episodeIds = Serie::findOrFail($id)->episodes()->pluck('id')->toArray();
        Auth::user()->seen()->attach($episodeIds);
        return back();
    }

    public function vuSaison(int $id, int $num): RedirectResponse
    {
        $episodeIds = Serie::findOrFail($id)
            ->episodes()
            ->where('saison', $num)
            ->pluck('id')
            ->toArray();

        Auth::user()->seen()->attach($episodeIds);
        return back();
    }
}
