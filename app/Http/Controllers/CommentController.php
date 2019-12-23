<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Serie;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $serie = Serie::find($id);
        return view('comments.create', $serie->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => ['required', 'max:450'],
            'note' => ['required', 'max:5'],
        ]);

        $input = $request->only(['content','note','id']);

        $comments = new Comment();

        $comments -> content = $input['content'];
        $comments -> note = $input['note'];
        $comments-> serie_id = $input['id'];
        $comments->validated = false;
        $comments-> user_id = $input['id'];


        $comments->save();

        return redirect(route('series.show', $input['id']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        $serie = Serie::find($id);
        return view('comment.edit', $serie->id);
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
            'content' => ['required', 'max:50'],
            'note' => ['required', 'max:5'],
        ]);

        $input = $request->only(['content','note']);

        $comments = Comment::find($id);

        $comments->content = $input['content'];
        $comments->note = $input['note'];

        $comments->save();

        return redirect('/comments');
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
            $comments = Comment::find($id);
            $comments->delete();
        }
        return redirect()->route('series.show');
    }
}
