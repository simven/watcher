<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $episodes = Episode::all();
        return view('episode.index',['episodes'=>$episodes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('episodes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        return redirect()->route('episodes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Episode $episode): View
    {
        return view('episodes.show', ['episode' => $episode]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Episode $episode): View
    {
        return view('episodes.edit', ['episode' => $episode]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Episode $episode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Episode $episode)
    {
        $episode->delete();
        return redirect()->route('episodes.index')->with('success', 'Episode deleted successfully.');
    }
}
