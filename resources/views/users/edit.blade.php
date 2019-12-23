@extends('base.master')

@section('title', 'Edition de profil')

@section('content')
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h1> Remplissez le formulaire pour modifier votre profil </h1>

    <form action="{{route('users.update',Auth::user()->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name"> Nom de l'utilisateur : </label>
            <input type="text" name="name" id="name"
                   value="{{Auth::user()->name}}">
        </div>
        <div>
            <label for="email"> Email de l'utilisateur : </label>
            <input type="text" id="email" name="email"
                   value="{{Auth::user()->email}}">
        </div>

        <div>
            <label for="password"> Mot de passe : </label>
            <input type="password" name="password" id="password"
                   value="{{Auth::user()->password}}">
        </div>


        <div>
            <label for="avatar"> Avatar :  </label>
            <input type="text" name="avatar" id="avatar"
                   value="{{Auth::user()->avatar}}">
        </div>
        <div>
            <button class="btn btn-success" type="submit" value="OK"> Valider </button>
        </div>
    </form>
@endsection
