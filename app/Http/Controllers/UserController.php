<?php

namespace App\Http\Controllers;

use App\Episode;
use App\User;
use App\Comment;
use App\Serie;
use Illuminate\Http\Request;

class UserController extends Controller
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
    public function create()
    {
        return view('auth.register');
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
            'name' => ['required', 'max:100'],
            'email' => ['required', 'max:50'],
            'password' => ['required', 'max:100'],
            'avatar' => ['max:50'],
        ]);

        $input = $request->only(['name','email','password']);

        $user = new User;

        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = $input['password'];

        $user->save();

        return redirect('/');
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
        $user = User::find($id);
        $nbEpisodesVus = User::where('id',$id)->rightJoin('seen','users.id','=','seen.user_id')->count();
        $nbHeuresVues = Episode::where('user_id',$id)->rightJoin('seen','episodes.id','=','seen.episode_id')->sum('duree');
        $nbAvisPostes = Comment::where('user_id',$id)->count();
        $commentairesUser = Comment::where('user_id',$id)->get();
        $seriesCommentees = Serie::where('user_id',$id)->join('comments','series.id','=','comments.serie_id')->get();
        $seriesVisionnees = Serie::where('user_id',$id)->distinct('series.name')->join('episodes','series.id','=','episodes.serie_id')->join('seen','episodes.id','=','seen.episode_id')->get('series.nom');
        return view('users.show',[
            'user'=>$user,
            'nbEpisodesVus'=>$nbEpisodesVus,
            'nbHeuresVues'=>$nbHeuresVues,
            'nbAvisPostes'=>$nbAvisPostes,
            'commentairesUser'=>$commentairesUser,
            'seriesCommentees'=>$seriesCommentees,
            'seriesVisionnees'=>$seriesVisionnees
        ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', ['user'=>$user]);
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
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50'],
            'password' => ['required', 'max:100'],
            'avatar' => ['max:50'],
        ]);

        $input = $request->only(['name','email','password']);

        $user = User::find($id);

        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = $input['password'];

        $user->save();

        return redirect('/users/'.$id);
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
            $user = User::find($id);
            $user->delete();
        }
        return redirect('/');
    }
}
