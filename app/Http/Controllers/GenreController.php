<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Serie;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = Genre::all();
        return view('genre.index',['genres'=>$genres]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($ids)
    {
        $serie = Serie::find($ids);
        return view('genre.create', $serie->ids);
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
            'nom' => ['required', 'max:50'],

        ]);

        $input = $request->only(['nom']);

        $genres = new Genre();

        $genres->nom = $input['nom'];

        $genres->save();

        return redirect('/genre');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $genre = Genre::find($id);
        return view('genre.edit', $genre->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nom' => ['required', 'max:50'],

        ]);

        $input = $request->only(['nom']);

        $genres = new Genre();

        $genres->nom = $input['nom'];

        $genres->save();

        return redirect('/genre');
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
            $genres = Genre::find($id);
            $genres->delete();
        }
        return redirect()->route('series.show');
    }
}
