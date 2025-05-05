<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Serie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $genres = Genre::all();
        return view('genre.index', ['genres' => $genres]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('genre.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'nom' => ['required', 'max:50'],
        ]);

        $genre = Genre::create($validatedData);

        return redirect()->route('genre.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre): View
    {
        return view('genre.show', ['genre' => $genre]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre): View
    {
        return view('genre.edit', $genre);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genre $genre): RedirectResponse
    {
        $validatedData = $request->validate([
            'nom' => ['required', 'max:50'],
        ]);

        $genre->update($validatedData);

        return redirect()->route('genre.show', $genre);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre): RedirectResponse
    {
        $genre->delete();
        return redirect()->route('genre.index')->with('success', 'Genre deleted successfully.');
    }
}
